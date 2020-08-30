<?php

declare(strict_types=1);

namespace App\Service\AsteroidDataProvider;

use App\Mapper\AsteroidMapper;
use App\Model\Asteroid\AsteroidItem;
use App\Repository\AsteroidRepository;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\ParameterBag;

class AsteroidDataProvider
{
    /**
     * @var AsteroidRepository
     */
    private $asteroidRepository;

    public function __construct(AsteroidRepository $asteroidRepository)
    {
        $this->asteroidRepository = $asteroidRepository;
    }

    public function getHazardousAsteroids(ParameterBag $parameterBag): array
    {
        $asteroids = $this->asteroidRepository->findAllHazardous($parameterBag);
        $asteroidItems = [];

        foreach ($asteroids as $asteroid) {
            $asteroidItems[] = AsteroidMapper::fromEntityToModel($asteroid);
        }

        return $asteroidItems;
    }

    public function getTheFastestAsteroid(ParameterBag $parameterBag): AsteroidItem
    {
        $asteroid = $this->asteroidRepository->findOneTheFastest($parameterBag);

        if (null === $asteroid) {
            throw new EntityNotFoundException('Asteroid is not found!');
        }

        return AsteroidMapper::fromEntityToModel($asteroid);
    }

    public function getTheBestMonth(ParameterBag $parameterBag): string
    {
        return $this->asteroidRepository->findBestMonth($parameterBag);
    }

    public function getHazardousAsteroidsTotalRows(ParameterBag $parameterBag): int
    {
        return $this->asteroidRepository->getTotalRowsHazardous($parameterBag);
    }
}
