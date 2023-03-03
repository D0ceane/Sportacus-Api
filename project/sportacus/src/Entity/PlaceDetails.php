<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlaceDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaceDetailsRepository::class)]
#[ApiResource]
class PlaceDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $geohash_place = null;

    #[ORM\Column(length: 255)]
    private ?string $image_place = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $schedule_opening = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $schedule_closing = null;

    #[ORM\Column]
    private ?int $stillopen = null;

    #[ORM\OneToOne(mappedBy: 'provide', cascade: ['persist', 'remove'])]
    private ?PlaceApi $placeApi = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGeohashPlace(): ?string
    {
        return $this->geohash_place;
    }

    public function setGeohashPlace(string $geohash_place): self
    {
        $this->geohash_place = $geohash_place;

        return $this;
    }

    public function getImagePlace(): ?string
    {
        return $this->image_place;
    }

    public function setImagePlace(string $image_place): self
    {
        $this->image_place = $image_place;

        return $this;
    }

    public function getScheduleOpening(): ?string
    {
        return $this->schedule_opening;
    }

    public function setScheduleOpening(?string $schedule_opening): self
    {
        $this->schedule_opening = $schedule_opening;

        return $this;
    }

    public function getScheduleClosing(): ?string
    {
        return $this->schedule_closing;
    }

    public function setScheduleClosing(?string $schedule_closing): self
    {
        $this->schedule_closing = $schedule_closing;

        return $this;
    }

    public function getStillopen(): ?int
    {
        return $this->stillopen;
    }

    public function setStillopen(int $stillopen): self
    {
        $this->stillopen = $stillopen;

        return $this;
    }

    public function getPlaceApi(): ?PlaceApi
    {
        return $this->placeApi;
    }

    public function setPlaceApi(PlaceApi $placeApi): self
    {
        // set the owning side of the relation if necessary
        if ($placeApi->getProvide() !== $this) {
            $placeApi->setProvide($this);
        }

        $this->placeApi = $placeApi;

        return $this;
    }
}
