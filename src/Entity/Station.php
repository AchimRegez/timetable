<?php

namespace App\Entity;

use App\Repository\StationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StationRepository::class)]
class Station
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $stationName = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $depature = null;

    #[ORM\Column(length: 255)]
    private ?string $direction = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $delay = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocationName(): ?string
    {
        return $this->locationName;
    }

    public function setLocationName(string $locationName): self
    {
        $this->locationName = $locationName;

        return $this;
    }

    public function getStationName(): ?string
    {
        return $this->stationName;
    }

    public function setStationName(string $stationName): self
    {
        $this->stationName = $stationName;

        return $this;
    }

    public function getDepature(): ?\DateTimeInterface
    {
        return $this->depature;
    }

    public function setDepature(\DateTimeInterface $depature): self
    {
        $this->depature = $depature;

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setDirection(string $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    public function getDelay(): ?\DateTimeInterface
    {
        return $this->delay;
    }

    public function setDelay(\DateTimeInterface $delay): self
    {
        $this->delay = $delay;

        return $this;
    }
}
