<?php


namespace App\Service\NasaApiClient;


interface NasaApiInterface
{
    public function getNeoFeed(string $startDate, string $endDate): array;
}