<?php


namespace App\Model\Asteroid;


class AsteroidItem
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $reference;

    /**
     * @var float
     */
    private $speed;

    /**
     * @var string
     */
    private $date;

    /**
     * @var bool
     */
    private $isHazardous;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AsteroidItem
     */
    public function setId(int $id): AsteroidItem
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AsteroidItem
     */
    public function setName(string $name): AsteroidItem
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getReference(): int
    {
        return $this->reference;
    }

    /**
     * @param int $reference
     * @return AsteroidItem
     */
    public function setReference(int $reference): AsteroidItem
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }

    /**
     * @param float $speed
     * @return AsteroidItem
     */
    public function setSpeed(float $speed): AsteroidItem
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return AsteroidItem
     */
    public function setDate(string $date): AsteroidItem
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHazardous(): bool
    {
        return $this->isHazardous;
    }

    /**
     * @param bool $isHazardous
     * @return AsteroidItem
     */
    public function setIsHazardous(bool $isHazardous): AsteroidItem
    {
        $this->isHazardous = $isHazardous;

        return $this;
    }

}