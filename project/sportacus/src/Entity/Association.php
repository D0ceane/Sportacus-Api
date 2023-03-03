<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AssociationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssociationRepository::class)]
#[ApiResource]
class Association
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_association = null;

    #[ORM\Column(length: 255)]
    private ?string $siren = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $creation_date = null;

    #[ORM\Column(length: 255)]
    private ?string $email_association = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'possess')]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'associations')]
    private ?ManageAssociation $allow = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameAssociation(): ?string
    {
        return $this->name_association;
    }

    public function setNameAssociation(string $name_association): self
    {
        $this->name_association = $name_association;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(?\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getEmailAssociation(): ?string
    {
        return $this->email_association;
    }

    public function setEmailAssociation(string $email_association): self
    {
        $this->email_association = $email_association;

        return $this;
    }

    public function getAllow(): ?ManageAssociation
    {
        return $this->allow;
    }

    public function setAllow(?ManageAssociation $allow): self
    {
        $this->allow = $allow;

        return $this;
    }
}
