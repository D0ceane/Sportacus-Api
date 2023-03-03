<?php

namespace App\Entity;

use App\Repository\ManageAssociationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ManageAssociationRepository::class)]
class ManageAssociation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column]
    private ?int $validate = null;

    #[ORM\OneToMany(mappedBy: 'Possess', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'allow', targetEntity: Association::class)]
    private Collection $associations;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->associations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getValidate(): ?int
    {
        return $this->validate;
    }

    public function setValidate(int $validate): self
    {
        $this->validate = $validate;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setPossess($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getPossess() === $this) {
                $user->setPossess(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Association>
     */
    public function getAssociations(): Collection
    {
        return $this->associations;
    }

    public function addAssociation(Association $association): self
    {
        if (!$this->associations->contains($association)) {
            $this->associations->add($association);
            $association->setAllow($this);
        }

        return $this;
    }

    public function removeAssociation(Association $association): self
    {
        if ($this->associations->removeElement($association)) {
            // set the owning side to null (unless already changed)
            if ($association->getAllow() === $this) {
                $association->setAllow(null);
            }
        }

        return $this;
    }
}
