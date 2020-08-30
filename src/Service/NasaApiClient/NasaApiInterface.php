<?php

declare(strict_types=1);

namespace App\Service\NasaApiClient;

interface NasaApiInterface
{
    /**
     * Retrieve the list of Asteroids.
     */
    public function getNeoFeed(string $startDate, string $endDate): array;
}
