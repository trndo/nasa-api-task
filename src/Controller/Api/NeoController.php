<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\PaginatedResponse;
use App\Service\AsteroidDataProvider\AsteroidDataProvider;
use App\Service\PaginatorService\Paginator;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NeoController extends AbstractFOSRestController
{
    /**
     * Get all hazardous asteroids.
     *
     * @Rest\Get("/api/neo/hazardous", name="hazardous_asteroids")
     */
    public function fetchHazardous(
        Request $request,
        AsteroidDataProvider $asteroidDataProvider,
        Paginator $paginator
    ): View {
        $asteroids = $asteroidDataProvider->getHazardousAsteroids($request->query);
        $totalRows = $asteroidDataProvider->getHazardousAsteroidsTotalRows($request->query);
        $response = new PaginatedResponse();

        $pagination = $paginator->createPagination(
            'hazardous_asteroids',
            $request->query->getInt('count', 10),
            $request->query->getInt('page', 1),
            $totalRows
        );

        $response->setData($asteroids)
            ->setLinks($pagination);

        return $this->view($response, Response::HTTP_OK);
    }

    /**
     * Get the fastest asteroid with optional value hazardous true/false.
     *
     * @Rest\Get("/api/neo/fastest", name="fastest_asteroid")
     */
    public function fetchTheFastest(
        Request $request,
        AsteroidDataProvider $asteroidDataProvider
    ): View {
        $asteroid = $asteroidDataProvider->getTheFastestAsteroid($request->query);

        return $this->view($asteroid, Response::HTTP_OK);
    }

    /**
     * Get the month with most asteroids with optional value hazardous true/false.
     *
     * @Rest\Get("/api/neo/best-month", name="best_month")
     */
    public function fetchTheBestMonth(
        Request $request,
        AsteroidDataProvider $asteroidDataProvider
    ): View {
        $month = $asteroidDataProvider->getTheBestMonth($request->query);

        return $this->view([
            'name' => $month,
        ], Response::HTTP_OK);
    }
}
