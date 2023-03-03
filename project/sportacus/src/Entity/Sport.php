<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SportRepository::class)]
#[ApiResource]
class Sport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_sport = null;

    #[ORM\Column(length: 255)]
    private ?string $type_sport = null;

    #[ORM\Column(nullable: true)]
    private ?int $player_max_sport = null;

    #[ORM\OneToMany(mappedBy: 'sport', targetEntity: Party::class)]
    private Collection $affect;

    #[ORM\ManyToMany(targetEntity: PlaceApi::class, inversedBy: 'sports')]
    private Collection $play;

    public function __construct()
    {
        $this->affect = new ArrayCollection();
        $this->play = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSport(): ?string
    {
        return $this->name_sport;
    }

    public function setNameSport(string $name_sport): self
    {
        $this->name_sport = $name_sport;

        return $this;
    }

    public function getTypeSport(): ?string
    {
        return $this->type_sport;
    }

    public function setTypeSport(string $type_sport): self
    {
        $this->type_sport = $type_sport;

        return $this;
    }

    public function getPlayerMaxSport(): ?int
    {
        return $this->player_max_sport;
    }

    public function setPlayerMaxSport(?int $player_max_sport): self
    {
        $this->player_max_sport = $player_max_sport;

        return $this;
    }

    /**
     * @return Collection<int, Party>
     */
    public function getAffect(): Collection
    {
        return $this->affect;
    }

    public function addAffect(Party $affect): self
    {
        if (!$this->affect->contains($affect)) {
            $this->affect->add($affect);
            $affect->setSport($this);
        }

        return $this;
    }

    public function removeAffect(Party $affect): self
    {
        if ($this->affect->removeElement($affect)) {
            // set the owning side to null (unless already changed)
            if ($affect->getSport() === $this) {
                $affect->setSport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlaceApi>
     */
    public function getPlay(): Collection
    {
        return $this->play;
    }

    public function addPlay(PlaceApi $play): self
    {
        if (!$this->play->contains($play)) {
            $this->play->add($play);
        }

        return $this;
    }

    public function removePlay(PlaceApi $play): self
    {
        $this->play->removeElement($play);

        return $this;
    }
}
