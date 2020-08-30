<?php


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
     * @Rest\Get("/neo/hazardous", name="hazardous")
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
            'hazardous',
            $request->query->getInt('count', 10),
            $request->query->getInt('page', 1),
            $totalRows
        );

        $response->setData($asteroids)
            ->setLinks($pagination);

        return $this->view($response, Response::HTTP_OK);
    }
}