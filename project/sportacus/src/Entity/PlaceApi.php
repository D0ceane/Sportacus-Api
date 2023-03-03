<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlaceApiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaceApiRepository::class)]
#[ApiResource]
class PlaceApi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $recordid = null;

    #[ORM\Column]
    private ?int $caract122 = null;

    #[ORM\Column(length: 255)]
    private ?string $commune = null;

    #[ORM\Column]
    private ?int $codepostal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomequipement = null;

    #[ORM\Column(length: 255)]
    private ?string $coordgpsy = null;

    #[ORM\Column(length: 255)]
    private ?string $coordgpsx = null;

    #[ORM\Column(nullable: true)]
    private ?bool $caract20 = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $caract168 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $caract167 = null;

    #[ORM\Column]
    private ?int $alreadyexist = null;

    #[ORM\ManyToMany(targetEntity: Sport::class, mappedBy: 'play')]
    private Collection $sports;

    #[ORM\OneToMany(mappedBy: 'placeApi', targetEntity: Party::class)]
    private Collection $compose;

    #[ORM\OneToOne(inversedBy: 'placeApi', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?PlaceDetails $provide = null;

    public function __construct()
    {
        $this->sports = new ArrayCollection();
        $this->compose = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecordid(): ?string
    {
        return $this->recordid;
    }

    public function setRecordid(string $recordid): self
    {
        $this->recordid = $recordid;

        return $this;
    }

    public function getCaract122(): ?int
    {
        return $this->caract122;
    }

    public function setCaract122(int $caract122): self
    {
        $this->caract122 = $caract122;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getCodepostal(): ?int
    {
        return $this->codepostal;
    }

    public function setCodepostal(int $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getNomequipement(): ?string
    {
        return $this->nomequipement;
    }

    public function setNomequipement(?string $nomequipement): self
    {
        $this->nomequipement = $nomequipement;

        return $this;
    }

    public function getCoordgpsy(): ?string
    {
        return $this->coordgpsy;
    }

    public function setCoordgpsy(string $coordgpsy): self
    {
        $this->coordgpsy = $coordgpsy;

        return $this;
    }

    public function getCoordgpsx(): ?string
    {
        return $this->coordgpsx;
    }

    public function setCoordgpsx(string $coordgpsx): self
    {
        $this->coordgpsx = $coordgpsx;

        return $this;
    }

    public function isCaract20(): ?bool
    {
        return $this->caract20;
    }

    public function setCaract20(?bool $caract20): self
    {
        $this->caract20 = $caract20;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCaract168(): ?string
    {
        return $this->caract168;
    }

    public function setCaract168(?string $caract168): self
    {
        $this->caract168 = $caract168;

        return $this;
    }

    public function getCaract167(): ?string
    {
        return $this->caract167;
    }

    public function setCaract167(?string $caract167): self
    {
        $this->caract167 = $caract167;

        return $this;
    }

    public function getAlreadyexist(): ?int
    {
        return $this->alreadyexist;
    }

    public function setAlreadyexist(int $alreadyexist): self
    {
        $this->alreadyexist = $alreadyexist;

        return $this;
    }

    /**
     * @return Collection<int, Sport>
     */
    public function getSports(): Collection
    {
        return $this->sports;
    }

    public function addSport(Sport $sport): self
    {
        if (!$this->sports->contains($sport)) {
            $this->sports->add($sport);
            $sport->addPlay($this);
        }

        return $this;
    }

    public function removeSport(Sport $sport): self
    {
        if ($this->sports->removeElement($sport)) {
            $sport->removePlay($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Party>
     */
    public function getCompose(): Collection
    {
        return $this->compose;
    }

    public function addCompose(Party $compose): self
    {
        if (!$this->compose->contains($compose)) {
            $this->compose->add($compose);
            $compose->setPlaceApi($this);
        }

        return $this;
    }

    public function removeCompose(Party $compose): self
    {
        if ($this->compose->removeElement($compose)) {
            // set the owning side to null (unless already changed)
            if ($compose->getPlaceApi() === $this) {
                $compose->setPlaceApi(null);
            }
        }

        return $this;
    }

    public function getProvide(): ?PlaceDetails
    {
        return $this->provide;
    }

    public function setProvide(PlaceDetails $provide): self
    {
        $this->provide = $provide;

        return $this;
    }
}
