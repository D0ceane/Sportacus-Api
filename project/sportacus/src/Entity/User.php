<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $first_name = null;

    #[ORM\Column(length: 50)]
    private ?string $last_name = null;

    #[ORM\Column(length: 50)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 50)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_of_birth = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profile_picture = null;

    #[ORM\Column(length: 50)]
    private ?string $is_active = null;

    #[ORM\OneToMany(mappedBy: 'User', targetEntity: Party::class)]
    private Collection $Participate;

    #[ORM\ManyToMany(targetEntity: Role::class, inversedBy: 'users')]
    private Collection $correspond;

    #[ORM\ManyToMany(targetEntity: association::class, inversedBy: 'users')]
    private Collection $possess;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?ManageAssociation $Possess = null;

    public function __construct()
    {
        $this->Participate = new ArrayCollection();
        $this->correspond = new ArrayCollection();
        $this->possess = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(\DateTimeInterface $date_of_birth): self
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(?string $profile_picture): self
    {
        $this->profile_picture = $profile_picture;

        return $this;
    }

    public function getIsActive(): ?string
    {
        return $this->is_active;
    }

    public function setIsActive(string $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * @return Collection<int, Party>
     */
    public function getParticipate(): Collection
    {
        return $this->Participate;
    }

    public function addParticipate(Party $participate): self
    {
        if (!$this->Participate->contains($participate)) {
            $this->Participate->add($participate);
            $participate->setUser($this);
        }

        return $this;
    }

    public function removeParticipate(Party $participate): self
    {
        if ($this->Participate->removeElement($participate)) {
            // set the owning side to null (unless already changed)
            if ($participate->getUser() === $this) {
                $participate->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getCorrespond(): Collection
    {
        return $this->correspond;
    }

    public function addCorrespond(Role $correspond): self
    {
        if (!$this->correspond->contains($correspond)) {
            $this->correspond->add($correspond);
        }

        return $this;
    }

    public function removeCorrespond(Role $correspond): self
    {
        $this->correspond->removeElement($correspond);

        return $this;
    }

    public function getPossess(): ?ManageAssociation
    {
        return $this->Possess;
    }

    public function setPossess(?ManageAssociation $Possess): self
    {
        $this->Possess = $Possess;

        return $this;
    }
}
