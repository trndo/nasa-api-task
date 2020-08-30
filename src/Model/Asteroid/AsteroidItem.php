<?php

declare(strict_types=1);

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

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getReference(): int
    {
        return $this->reference;
    }

    public function setReference(int $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getSpeed(): float
    {
        return $this->speed;
    }

    public function setSpeed(float $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function isHazardous(): bool
    {
        return $this->isHazardous;
    }

    public function setIsHazardous(bool $isHazardous): self
    {
        $this->isHazardous = $isHazardous;

        return $this;
    }
}
