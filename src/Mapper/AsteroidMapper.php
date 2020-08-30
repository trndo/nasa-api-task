<?php


namespace App\Mapper;


use App\Entity\Asteroid;
use App\Model\Asteroid\AsteroidItem;

class AsteroidMapper
{
    private const NAME = 'name';
    private const REFERENCE = 'neo_reference_id';
    private const SPEED = 'kilometers_per_hour';
    private const IS_HAZARDOUS= 'is_potentially_hazardous_asteroid';
    private const DATE = 'close_approach_date';
    private const CLOSE_APPROACH_DATA = 'close_approach_data';
    private const RELATIVE_VELOCITY = 'relative_velocity';

    public static function fromResponseToEntity(array $response, Asteroid $asteroid): Asteroid
    {
        $date = new \DateTime($response[self::CLOSE_APPROACH_DATA][0][self::DATE]);

        $asteroid->setDate($date)
            ->setName($response[self::NAME])
            ->setIsHazardous($response[self::IS_HAZARDOUS])
            ->setReference($response[self::REFERENCE])
            ->setSpeed($response[self::CLOSE_APPROACH_DATA][0][self::RELATIVE_VELOCITY][self::SPEED]);

        return $asteroid;
    }

    public static function fromEntityToModel(Asteroid $asteroid): AsteroidItem
    {
        $asteroidItem = new AsteroidItem();

        $asteroidItem->setId($asteroid->getId())
            ->setName($asteroid->getName())
            ->setSpeed($asteroid->getSpeed())
            ->setReference($asteroid->getReference())
            ->setIsHazardous($asteroid->getIsHazardous())
            ->setDate($asteroid->getDate()->format('Y-m-d'));

        return $asteroidItem;
    }
}