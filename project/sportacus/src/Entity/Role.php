<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ApiResource]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $role_type = null;

    #[ORM\Column(length: 255)]
    private ?string $name_type = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'correspond')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleType(): ?int
    {
        return $this->role_type;
    }

    public function setRoleType(int $role_type): self
    {
        $this->role_type = $role_type;

        return $this;
    }

    public function getNameType(): ?string
    {
        return $this->name_type;
    }

    public function setNameType(string $name_type): self
    {
        $this->name_type = $name_type;

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
            $user->addCorrespond($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeCorrespond($this);
        }

        return $this;
    }
}
