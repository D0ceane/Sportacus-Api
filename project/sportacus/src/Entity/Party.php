<?php

namespace App\Entity;

use App\Repository\PartyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartyRepository::class)]
class Party
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_party = null;

    #[ORM\Column]
    private ?int $player_max_party = null;

    #[ORM\ManyToOne(inversedBy: 'Participate')]
    private ?user $user = null;

    #[ORM\ManyToOne(inversedBy: 'affect')]
    private ?Sport $sport = null;

    #[ORM\ManyToOne(inversedBy: 'compose')]
    private ?PlaceApi $placeApi = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameParty(): ?string
    {
        return $this->name_party;
    }

    public function setNameParty(string $name_party): self
    {
        $this->name_party = $name_party;

        return $this;
    }

    public function getPlayerMaxParty(): ?int
    {
        return $this->player_max_party;
    }

    public function setPlayerMaxParty(int $player_max_party): self
    {
        $this->player_max_party = $player_max_party;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSport(): ?Sport
    {
        return $this->sport;
    }

    public function setSport(?Sport $sport): self
    {
        $this->sport = $sport;

        return $this;
    }

    public function getPlaceApi(): ?PlaceApi
    {
        return $this->placeApi;
    }

    public function setPlaceApi(?PlaceApi $placeApi): self
    {
        $this->placeApi = $placeApi;

        return $this;
    }
}
