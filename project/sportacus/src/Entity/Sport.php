<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\SportRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SportRepository::class)]
#[ApiResource(
    description: 'Sport Model',
    operations: [
        new GetCollection(
            uriTemplate: '/sports',
            normalizationContext: [
                'groups' => ['read:Sport:collection'],
                'openapi_definition_name' => 'Read Collection'
            ],
        ),
        new Get(
            uriTemplate: '/sports/{id}',
            normalizationContext: [
                'groups' => ['read:Sport:item'],
                'openapi_definition_name' => 'Read Item']
        ),
        new Post(
            uriTemplate: '/sports',
            denormalizationContext: [
                'groups' => ['write:Sport:item'],
                'openapi_definition_name' => 'Write Item'
            ],
        ),
        new Put(
            uriTemplate: '/manage-sport',
            normalizationContext: [
                'groups' => ['read:Sport:item'],
                'openapi_definition_name' => 'Read Collection'
            ],
            denormalizationContext: [
                'groups' => ['write:Sport:item'],
                'openapi_definition_name' => 'Write Item'
            ],
        ),
        new Patch(
            uriTemplate: '/updated-sport/{id}',
            normalizationContext: [
                'groups' => ['read:Sport:item'],
                'openapi_definition_name' => 'Read Collection'
            ],
            denormalizationContext: [
                'groups' => ['write:Sport:item'],
                'openapi_definition_name' => 'Write Item'
            ],
        ),
        new Delete(
            uriTemplate: '/deleted-sport/{id}',
            denormalizationContext: [
                'groups' => ['write:Sport:item'],
                'openapi_definition_name' => 'Write Item'
            ],
        ),
    ],
    paginationClientItemsPerPage: true,
    paginationItemsPerPage: 1,
    paginationMaximumItemsPerPage: 10
)]
#[ApiFilter(
    SearchFilter::class, properties: [
        'nameSport' => 'partial',
        'typeSport' => 'exact',
        'playerMaxSport' => 'exact',
        'createdAtSport' => 'partial',
        'updatedAtSport' => 'partial'
    ]
)]
class Sport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[
        Groups(['read:Sport:collection', 'read:Sport:item', 'write:Sport:item']),
        Length(min: 2, max: 200),
        ApiProperty(
            openapiContext: [
                'type' => 'string',
                'minimum' => '2',
                'maximum' => '200'
            ]
        )
    ]
    #@Table(name="name_sport")
    private ?string $nameSport = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[
        Groups(['read:Sport:item', 'write:Sport:item']),
        Assert\Length(min: 2, max: 100),
        ApiProperty(
            openapiContext: [
                'description' => 'allows to know if the sport is individual or collective',
                'type' => 'string',
                'enum' => ['individual', 'collective']
                ])
    ]
    #@Table(name="type_sport")
    private ?string $typeSport = null;

    #[ORM\Column(nullable: true)]
    #[
        Length(min: 1, max: 3),
        Groups(['read:Sport:item', 'write:Sport:item'])
    ]
    #@Table(name="player_max_sport")
    private ?int $playerMaxSport = null;

    #[
        Groups(['read:Sport:item', 'write:Sport:item'])
    ]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAtSport = null;

    #[Groups(['read:Sport:item', 'write:Sport:item'])]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAtSport = null;

    #[Groups(['read:Sport:item', 'write:Sport:item'])]
    #[
        ORM\ManyToOne(inversedBy: 'sport'),
        ORM\JoinColumn(nullable: true)
    ]
    private ?Practising $practising = null;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNameSport(): ?string
    {
        return $this->nameSport;
    }

    public function setNameSport(?string $nameSport): self
    {
        $this->nameSport = $nameSport;

        return $this;
    }

    public function getTypeSport(): ?string
    {
        return $this->typeSport;
    }

    public function setTypeSport(?string $typeSport): self
    {
        $this->typeSport = $typeSport;

        return $this;
    }

    public function getPlayerMaxSport(): ?int
    {
        return $this->playerMaxSport;
    }

    public function setPlayerMaxSport(?int $playerMaxSport): self
    {
        $this->playerMaxSport = $playerMaxSport;

        return $this;
    }

    public function getCreatedAtSport(): ?\DateTimeInterface
    {
        return $this->createdAtSport;
    }

    public function setCreatedAtSport(\DateTimeInterface $createdAtSport): self
    {
        $this->createdAtSport = $createdAtSport;

        return $this;
    }

    public function getUpdatedAtSport(): ?\DateTimeInterface
    {
        return $this->updatedAtSport;
    }

    public function setUpdatedAtSport(\DateTimeInterface $updatedAtSport): self
    {
        $this->updatedAtSport = $updatedAtSport;

        return $this;
    }

    public function getPractising(): ?Practising
    {
        return $this->practising;
    }

    public function setPractising(?Practising $practising): self
    {
        $this->practising = $practising;

        return $this;
    }

}
