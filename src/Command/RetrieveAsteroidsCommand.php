<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Asteroid;
use App\Mapper\AsteroidMapper;
use App\Repository\AsteroidRepository;
use App\Service\NasaApiClient\NasaApiInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RetrieveAsteroidsCommand extends Command
{
    protected static $defaultName = 'app:retrieve-asteroids';

    /**
     * @var NasaApiInterface
     */
    private $nasaApiClient;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var AsteroidRepository
     */
    private $repository;

    public function __construct(
        NasaApiInterface $nasaApiClient,
        EntityManagerInterface $entityManager,
        AsteroidRepository $repository
    ) {
        parent::__construct();
        $this->nasaApiClient = $nasaApiClient;
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    protected function configure(): void
    {
        $currentDate = new \DateTime();
        $defaultEndDate = $currentDate->format('Y-m-d');
        $defaultStartDate = $currentDate->modify('-2 day')->format('Y-m-d');

        $this
            ->setDescription(
                'Retrieve the list of Asteroids based on their closest approach date to Earth.'
            )
            ->addArgument(
                'startDate',
                InputArgument::OPTIONAL,
                'Starting date for asteroid search YYYY-MM-DD',
                $defaultStartDate
            )
            ->addArgument('endDate',
                InputArgument::OPTIONAL,
                'Ending date for asteroid search YYYY-MM-DD',
                $defaultEndDate
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $index = 0;

        $startDate = $input->getArgument('startDate');
        $endDate = $input->getArgument('endDate');

        try {
            $this->validateDate($startDate);
            $this->validateDate($endDate);

            $response = $this->nasaApiClient->getNeoFeed($startDate, $endDate);

            foreach ($response['near_earth_objects'] as $date => $objects) {
                $asteroid = $this->repository->findOneByDate($date);

                //If at least one record was found for chosen date.
                //Skip iteration to prevent duplicates with chosen date.
                if (null !== $asteroid) {
                    continue;
                }

                foreach ($objects as $asteroid) {
                    $asteroid = AsteroidMapper::fromResponseToEntity($asteroid, new Asteroid());
                    $this->entityManager->persist($asteroid);

                    if (0 === $index % 100) {
                        $this->entityManager->flush();
                        $this->entityManager->clear();
                    }

                    ++$index;
                }
            }

            $this->entityManager->flush();
            $io->success('The list of asteroids was successfully retrieved!');

            return 0;
        } catch (\Throwable $exception) {
            $io->error($exception->getMessage());

            return 1;
        }
    }

    private function validateDate(string $date, $format = 'Y-m-d'): void
    {
        $inputDate = \DateTime::createFromFormat($format, $date);

        if (!$inputDate instanceof \DateTime || $inputDate->format($format) !== $date) {
            throw new \InvalidArgumentException('Invalid date format. Format should be YYYY-MM-DD');
        }
    }
}
