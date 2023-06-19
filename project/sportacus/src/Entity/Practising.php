<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PractisingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PractisingRepository::class)]
#[ApiResource(
    description: 'Join table between Sport and PlaceApi',
    normalizationContext: [
        'groups' => ['read:Practising:item'],
        'openapi_definition_name' => 'Read item'
    ],
    denormalizationContext: [
        'groups' => ['write:Practising:item'],
        'openapi_definition_name' => 'Write item'
    ],
    paginationClientItemsPerPage: true,
    paginationItemsPerPage: 1,
    paginationMaximumItemsPerPage: 10
)]
class Practising
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[
        Groups(['read:Practising:item', 'write:Practising:item']),
        Assert\NotBlank, Assert\NotNull
    ]
    #[
        ORM\OneToMany(mappedBy: 'practising', targetEntity: Sport::class),
        ORM\JoinColumn(nullable: false)
    ]
    private Collection $sport;

    #[
        Groups(['read:Practising:item', 'write:Practising:item']),
        Assert\NotBlank, Assert\NotNull
    ]
    #[
        ORM\OneToMany(mappedBy: 'practising', targetEntity: PlaceApi::class, cascade: ['persist', 'remove']),
        ORM\JoinColumn(nullable: false)
    ]
    private Collection $placeApi;

    public function __construct()
    {
        $this->sport = new ArrayCollection();
        $this->placeApi = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Sport>
     */
    public function getSport(): Collection
    {
        return $this->sport;
    }

    public function addSport(Sport $sport): self
    {
        if (!$this->sport->contains($sport)) {
            $this->sport->add($sport);
            $sport->setPractising($this);
        }

        return $this;
    }

    public function removeSport(Sport $sport): self
    {
        if ($this->sport->removeElement($sport)) {
            // set the owning side to null (unless already changed)
            if ($sport->getPractising() === $this) {
                $sport->setPractising(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlaceApi>
     */
    public function getPlaceApi(): Collection
    {
        return $this->placeApi;
    }

    public function addPlaceApi(PlaceApi $placeApi): self
    {
        if (!$this->placeApi->contains($placeApi)) {
            $this->placeApi->add($placeApi);
            $placeApi->setPractising($this);
        }

        return $this;
    }

    public function removePlaceApi(PlaceApi $placeApi): self
    {
        if ($this->placeApi->removeElement($placeApi)) {
            // set the owning side to null (unless already changed)
            if ($placeApi->getPractising() === $this) {
                $placeApi->setPractising(null);
            }
        }

        return $this;
    }
}
