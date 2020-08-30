<?php


namespace App\Service\AsteroidDataProvider;


use App\Mapper\AsteroidMapper;
use App\Model\PaginatedResponse;
use App\Repository\AsteroidRepository;
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
        dd($asteroids);
        $asteroidItems = [];

        foreach ($asteroids as $asteroid) {
            $asteroidItems[] = AsteroidMapper::fromEntityToModel($asteroid);
        }

        return $asteroidItems;
    }

    public function getHazardousAsteroidsTotalRows(ParameterBag $parameterBag): int
    {
        return $this->asteroidRepository->getTotalRowsHazardous($parameterBag);
    }
}