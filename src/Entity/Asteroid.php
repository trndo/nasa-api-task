<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\AsteroidRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AsteroidRepository::class)
 * @ORM\Table(
 *     name="asteroid",
 *     indexes={
 *          @ORM\Index(name="isHazardous", columns={"is_hazardous"}),
 *          @ORM\Index(name="speed", columns={"speed"})
 *     }
 * )
 */
class Asteroid
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="reference", type="integer")
     */
    private $reference;

    /**
     * @ORM\Column(name="speed", type="float")
     */
    private $speed;

    /**
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(name="is_hazardous", type="boolean")
     */
    private $isHazardous;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getReference(): ?int
    {
        return $this->reference;
    }

    public function setReference(int $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getSpeed(): ?float
    {
        return $this->speed;
    }

    public function setSpeed(float $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIsHazardous(): ?bool
    {
        return $this->isHazardous;
    }

    public function setIsHazardous(bool $isHazardous): self
    {
        $this->isHazardous = $isHazardous;

        return $this;
    }
}
