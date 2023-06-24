<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\PlaceApiRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlaceApiRepository::class)]
#[ApiResource(
    description: 'Place Api Model: We use api of equipements.sports.gouv with just the information useful to sportacus',
    operations: [
        new GetCollection(
            uriTemplate: '/place-api',
            normalizationContext: [
                'groups' => ['read:PlaceApi:collection'],
                'openapi_definition_name' => 'Read Collection'
            ],
        ),
        new Get(
            uriTemplate: '/place-api/{id}',
            normalizationContext: [
                'groups' => ['read:PlaceApi:item'],
                'openapi_definition_name' => 'Read Item'
            ]
        ),
        new Post(
            uriTemplate: '/created-place-api',
            normalizationContext: [
                'groups' => ['read:PlaceApi:item']
            ],
            denormalizationContext: [
                'groups' => ['write:PlaceApi:item', 'write:PlaceApi:collection']
            ]
        ),
        new Put(
            uriTemplate: '/manage-place-api',
            normalizationContext: [
                'groups' => ['read:PlaceApi:item']
            ],
            denormalizationContext: [
                'groups' => ['write:PlaceApi:item']
            ]
        ),
        new Patch(
            uriTemplate: '/updated-place-api/{id}',
            normalizationContext: [
                'groups' => ['read:PlaceApi:item']
            ],
            denormalizationContext: [
                'groups' => ['write:PlaceApi:item']
            ]
        ),
        new Delete(
            uriTemplate: '/deleted-place-api/{id}',
            denormalizationContext: [
                'groups' => ['write:PlaceApi:item']
            ]
        ),
    ],
    paginationClientItemsPerPage: true,
    paginationItemsPerPage: 10,
    paginationMaximumItemsPerPage: 10
)]
#[ApiFilter(
    SearchFilter::class, properties: [
    'installationName' => 'partial',
    'typequipement' => 'partial',
    'postalCode' => 'exact',
    'accessibleInstallationToPeopleWithDisabilities' => 'exact',
    'installationAccessibilityAccordingDisabilityType' => 'partial'
]
)]
class PlaceApi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name:'numinstallation',type: Types::TEXT)]
    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    private ?string $installationNumber = null;

    #[Groups(['read:PlaceApi:collection', 'read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'nominstallation', type: Types::TEXT)]
    private ?string $installationName = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $adresse = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'codepostal', type: Types::TEXT)]
    private ?string $postalCode = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $commune = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'codeinsee', type: Types::TEXT)]
    private ?string $inseeCode = null;

    #[Groups(['read:PlaceApi:collection', 'read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract3',type: Types::TEXT)]
    private ?string $accessibleInstallationToPeopleWithDisabilities = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract9', type: Types::TEXT)]
    private ?string $eatingIsPossible = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract10', type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $numberOfEquipmentInInstallation = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract12',type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $numberOfParkingSpaces = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract13',type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $numberOfParkingSpacesForPeopleWithDisabilities = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract16',type: Types::TEXT)]
    private ?string $specialInstallation = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract19',type: Types::TEXT)]
    private ?string $installationFeatureType = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract20',type: Types::TEXT)]
    private ?string $installationAccessibilityAccordingDisabilityType = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'nomequipement',type: Types::TEXT)]
    private ?string $equipmentName = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $typequipement = null;

    #[Groups(['read:PlaceApi:collection', 'write:PlaceApi:collection', 'read:PlaceApi:item'])]
    #[ORM\Column(name: 'famille', type: Types::TEXT)]
    private ?string $equipmentFamily = null;

    #[Groups(['read:PlaceApi:collection', 'read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 8)]
    private ?string $coordgpsx = null;

    #[Groups(['read:PlaceApi:collection', 'read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 8)]
    private ?string $coordgpsy = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract24',type: Types::TEXT)]
    private ?string $lightingOfTheEvolutionArea = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract25', type: Types::TEXT)]
    private ?string $freeAccessEquipment = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract26',type: Types::TEXT)]
    private ?string $informationFacilities = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract27',type: Types::TEXT)]
    private ?string $amenitiesForComfort = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract74',)]
    private ?int $numberOfSportsLockerRooms = null;

    #[Groups(['read:PlaceApi:collection', 'read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract29',type: Types::TEXT)]
    private ?string $orderToOpenToThePublic = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract33',type: Types::TEXT)]
    private ?string $SeasonalOpeningOnly = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract34',type: Types::TEXT)]
    private ?string $presenceOfShower = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract35',type: Types::TEXT)]
    private ?string $presenceOfSanitary = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract47', type: Types::TEXT)]
    private ?string $complementaryArrangementsOfTheBasins = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract49', type: Types::TEXT)]
    private ?string $partialOrTotalAccessibilityForPeopleReducedMobility = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract53', type: Types::TEXT)]
    private ?string $accessibilityForPeopleReducedMobilityToShowers = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract54', type: Types::TEXT)]
    private ?string $accessibilityForPeopleReducedMobilityToSanitaryFacilities = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract55', type: Types::TEXT)]
    private ?string $accessibilityToTheStandsForPeopleReducedMobility = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract56', type: Types::TEXT)]
    private ?string $accessibilityToPersonsReducedMobilityInLockerRooms = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract57',type: Types::TEXT)]
    private ?string $partialOrTotalAccessibilityForPeopleSensoryDisabilities = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract60', type: Types::TEXT)]
    private ?string $accessibilityForPeopleSensoryDisabilitiesToSanitaryFacilities = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract62', type: Types::TEXT)]
    private ?string $accessibilityToTheStandsForPeopleSensoryDisabilities = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract63', type: Types::TEXT)]
    private ?string $accessibilityToPersonsSensoryDisabilitiesInLockerRooms = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract78',type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $lengthOfTheBasin = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract79',type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $widthOfTheBasin = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract80',type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $basinSurface = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract81',type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $minimumBasinDepth = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract82',type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $maximumBasinDepth = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract93',type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $trackLength = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract155',type: Types::TEXT)]
    private ?string $typeOfUse = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract116',type: Types::TEXT)]
    private ?string $nameOfBuilding = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract159', type: Types::TEXT)]
    private ?string $typeOfUsers = null;

    #[Groups(['read:PlaceApi:item', 'write:PlaceApi:item'])]
    #[ORM\Column(name: 'caract167',type: Types::TEXT)]
    private ?string $typeOfSoil = null;

    #[Groups(['read:PlaceApi:collection', 'write:PlaceApi:collection'])]
    #[
        ORM\ManyToOne(inversedBy: 'placeApi'),
        ORM\JoinColumn(nullable: true)
    ]
    private ?Practising $practising = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return string|null
     */
    public function getInstallationNumber(): ?string
    {
        return $this->installationNumber;
    }

    /**
     * @param string|null $installationNumber
     */
    public function setInstallationNumber(?string $installationNumber): void
    {
        $this->installationNumber = $installationNumber;
    }

    /**
     * @return string|null
     */
    public function getInstallationName(): ?string
    {
        return $this->installationName;
    }

    /**
     * @param string|null $installationName
     */
    public function setInstallationName(?string $installationName): void
    {
        $this->installationName = $installationName;
    }

    /**
     * @return string|null
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string|null $adresse
     */
    public function setAdresse(?string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string|null
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string|null $postalCode
     */
    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string|null
     */
    public function getCommune(): ?string
    {
        return $this->commune;
    }

    /**
     * @param string|null $commune
     */
    public function setCommune(?string $commune): void
    {
        $this->commune = $commune;
    }

    /**
     * @return string|null
     */
    public function getInseeCode(): ?string
    {
        return $this->inseeCode;
    }

    /**
     * @param string|null $inseeCode
     */
    public function setInseeCode(?string $inseeCode): void
    {
        $this->inseeCode = $inseeCode;
    }

    /**
     * @return string|null
     */
    public function getAccessibleInstallationToPeopleWithDisabilities(): ?string
    {
        return $this->accessibleInstallationToPeopleWithDisabilities;
    }

    /**
     * @param string|null $accessibleInstallationToPeopleWithDisabilities
     */
    public function setAccessibleInstallationToPeopleWithDisabilities(?string $accessibleInstallationToPeopleWithDisabilities): void
    {
        $this->accessibleInstallationToPeopleWithDisabilities = $accessibleInstallationToPeopleWithDisabilities;
    }

    /**
     * @return string|null
     */
    public function getEatingIsPossible(): ?string
    {
        return $this->eatingIsPossible;
    }

    /**
     * @param string|null $eatingIsPossible
     */
    public function setEatingIsPossible(?string $eatingIsPossible): void
    {
        $this->eatingIsPossible = $eatingIsPossible;
    }

    /**
     * @return string|null
     */
    public function getNumberOfEquipmentInInstallation(): ?string
    {
        return $this->numberOfEquipmentInInstallation;
    }

    /**
     * @param string|null $numberOfEquipmentInInstallation
     */
    public function setNumberOfEquipmentInInstallation(?string $numberOfEquipmentInInstallation): void
    {
        $this->numberOfEquipmentInInstallation = $numberOfEquipmentInInstallation;
    }

    /**
     * @return string|null
     */
    public function getNumberOfParkingSpaces(): ?string
    {
        return $this->numberOfParkingSpaces;
    }

    /**
     * @param string|null $numberOfParkingSpaces
     */
    public function setNumberOfParkingSpaces(?string $numberOfParkingSpaces): void
    {
        $this->numberOfParkingSpaces = $numberOfParkingSpaces;
    }

    /**
     * @return string|null
     */
    public function getNumberOfParkingSpacesForPeopleWithDisabilities(): ?string
    {
        return $this->numberOfParkingSpacesForPeopleWithDisabilities;
    }

    /**
     * @param string|null $numberOfParkingSpacesForPeopleWithDisabilities
     */
    public function setNumberOfParkingSpacesForPeopleWithDisabilities(?string $numberOfParkingSpacesForPeopleWithDisabilities): void
    {
        $this->numberOfParkingSpacesForPeopleWithDisabilities = $numberOfParkingSpacesForPeopleWithDisabilities;
    }

    /**
     * @return string|null
     */
    public function getSpecialInstallation(): ?string
    {
        return $this->specialInstallation;
    }

    /**
     * @param string|null $specialInstallation
     */
    public function setSpecialInstallation(?string $specialInstallation): void
    {
        $this->specialInstallation = $specialInstallation;
    }

    /**
     * @return string|null
     */
    public function getInstallationFeatureType(): ?string
    {
        return $this->installationFeatureType;
    }

    /**
     * @param string|null $installationFeatureType
     */
    public function setInstallationFeatureType(?string $installationFeatureType): void
    {
        $this->installationFeatureType = $installationFeatureType;
    }

    /**
     * @return string|null
     */
    public function getInstallationAccessibilityAccordingDisabilityType(): ?string
    {
        return $this->installationAccessibilityAccordingDisabilityType;
    }

    /**
     * @param string|null $installationAccessibilityAccordingDisabilityType
     */
    public function setInstallationAccessibilityAccordingDisabilityType(?string $installationAccessibilityAccordingDisabilityType): void
    {
        $this->installationAccessibilityAccordingDisabilityType = $installationAccessibilityAccordingDisabilityType;
    }

    /**
     * @return string|null
     */
    public function getEquipmentName(): ?string
    {
        return $this->equipmentName;
    }

    /**
     * @param string|null $equipmentName
     */
    public function setEquipmentName(?string $equipmentName): void
    {
        $this->equipmentName = $equipmentName;
    }

    /**
     * @return string|null
     */
    public function getTypequipement(): ?string
    {
        return $this->typequipement;
    }

    /**
     * @param string|null $typequipement
     */
    public function setTypequipement(?string $typequipement): void
    {
        $this->typequipement = $typequipement;
    }

    /**
     * @return string|null
     */
    public function getEquipmentFamily(): ?string
    {
        return $this->equipmentFamily;
    }

    /**
     * @param string|null $equipmentFamily
     */
    public function setEquipmentFamily(?string $equipmentFamily): void
    {
        $this->equipmentFamily = $equipmentFamily;
    }

    /**
     * @return string|null
     */
    public function getCoordgpsx(): ?string
    {
        return $this->coordgpsx;
    }

    /**
     * @param string|null $coordgpsx
     */
    public function setCoordgpsx(?string $coordgpsx): void
    {
        $this->coordgpsx = $coordgpsx;
    }

    /**
     * @return string|null
     */
    public function getCoordgpsy(): ?string
    {
        return $this->coordgpsy;
    }

    /**
     * @param string|null $coordgpsy
     */
    public function setCoordgpsy(?string $coordgpsy): void
    {
        $this->coordgpsy = $coordgpsy;
    }

    /**
     * @return string|null
     */
    public function getLightingOfTheEvolutionArea(): ?string
    {
        return $this->lightingOfTheEvolutionArea;
    }

    /**
     * @param string|null $lightingOfTheEvolutionArea
     */
    public function setLightingOfTheEvolutionArea(?string $lightingOfTheEvolutionArea): void
    {
        $this->lightingOfTheEvolutionArea = $lightingOfTheEvolutionArea;
    }

    /**
     * @return string|null
     */
    public function getFreeAccessEquipment(): ?string
    {
        return $this->freeAccessEquipment;
    }

    /**
     * @param string|null $freeAccessEquipment
     */
    public function setFreeAccessEquipment(?string $freeAccessEquipment): void
    {
        $this->freeAccessEquipment = $freeAccessEquipment;
    }

    /**
     * @return string|null
     */
    public function getInformationFacilities(): ?string
    {
        return $this->informationFacilities;
    }

    /**
     * @param string|null $informationFacilities
     */
    public function setInformationFacilities(?string $informationFacilities): void
    {
        $this->informationFacilities = $informationFacilities;
    }

    /**
     * @return string|null
     */
    public function getAmenitiesForComfort(): ?string
    {
        return $this->amenitiesForComfort;
    }

    /**
     * @param string|null $amenitiesForComfort
     */
    public function setAmenitiesForComfort(?string $amenitiesForComfort): void
    {
        $this->amenitiesForComfort = $amenitiesForComfort;
    }

    /**
     * @return int|null
     */
    public function getNumberOfSportsLockerRooms(): ?int
    {
        return $this->numberOfSportsLockerRooms;
    }

    /**
     * @param int|null $numberOfSportsLockerRooms
     */
    public function setNumberOfSportsLockerRooms(?int $numberOfSportsLockerRooms): void
    {
        $this->numberOfSportsLockerRooms = $numberOfSportsLockerRooms;
    }

    /**
     * @return string|null
     */
    public function getOrderToOpenToThePublic(): ?string
    {
        return $this->orderToOpenToThePublic;
    }

    /**
     * @param string|null $orderToOpenToThePublic
     */
    public function setOrderToOpenToThePublic(?string $orderToOpenToThePublic): void
    {
        $this->orderToOpenToThePublic = $orderToOpenToThePublic;
    }

    /**
     * @return string|null
     */
    public function getSeasonalOpeningOnly(): ?string
    {
        return $this->SeasonalOpeningOnly;
    }

    /**
     * @param string|null $SeasonalOpeningOnly
     */
    public function setSeasonalOpeningOnly(?string $SeasonalOpeningOnly): void
    {
        $this->SeasonalOpeningOnly = $SeasonalOpeningOnly;
    }

    /**
     * @return string|null
     */
    public function getPresenceOfShower(): ?string
    {
        return $this->presenceOfShower;
    }

    /**
     * @param string|null $presenceOfShower
     */
    public function setPresenceOfShower(?string $presenceOfShower): void
    {
        $this->presenceOfShower = $presenceOfShower;
    }

    /**
     * @return string|null
     */
    public function getPresenceOfSanitary(): ?string
    {
        return $this->presenceOfSanitary;
    }

    /**
     * @param string|null $presenceOfSanitary
     */
    public function setPresenceOfSanitary(?string $presenceOfSanitary): void
    {
        $this->presenceOfSanitary = $presenceOfSanitary;
    }

    /**
     * @return string|null
     */
    public function getComplementaryArrangementsOfTheBasins(): ?string
    {
        return $this->complementaryArrangementsOfTheBasins;
    }

    /**
     * @param string|null $complementaryArrangementsOfTheBasins
     */
    public function setComplementaryArrangementsOfTheBasins(?string $complementaryArrangementsOfTheBasins): void
    {
        $this->complementaryArrangementsOfTheBasins = $complementaryArrangementsOfTheBasins;
    }

    /**
     * @return string|null
     */
    public function getPartialOrTotalAccessibilityForPeopleReducedMobility(): ?string
    {
        return $this->partialOrTotalAccessibilityForPeopleReducedMobility;
    }

    /**
     * @param string|null $partialOrTotalAccessibilityForPeopleReducedMobility
     */
    public function setPartialOrTotalAccessibilityForPeopleReducedMobility(?string $partialOrTotalAccessibilityForPeopleReducedMobility): void
    {
        $this->partialOrTotalAccessibilityForPeopleReducedMobility = $partialOrTotalAccessibilityForPeopleReducedMobility;
    }

    /**
     * @return string|null
     */
    public function getAccessibilityForPeopleReducedMobilityToShowers(): ?string
    {
        return $this->accessibilityForPeopleReducedMobilityToShowers;
    }

    /**
     * @param string|null $accessibilityForPeopleReducedMobilityToShowers
     */
    public function setAccessibilityForPeopleReducedMobilityToShowers(?string $accessibilityForPeopleReducedMobilityToShowers): void
    {
        $this->accessibilityForPeopleReducedMobilityToShowers = $accessibilityForPeopleReducedMobilityToShowers;
    }

    /**
     * @return string|null
     */
    public function getAccessibilityForPeopleReducedMobilityToSanitaryFacilities(): ?string
    {
        return $this->accessibilityForPeopleReducedMobilityToSanitaryFacilities;
    }

    /**
     * @param string|null $accessibilityForPeopleReducedMobilityToSanitaryFacilities
     */
    public function setAccessibilityForPeopleReducedMobilityToSanitaryFacilities(?string $accessibilityForPeopleReducedMobilityToSanitaryFacilities): void
    {
        $this->accessibilityForPeopleReducedMobilityToSanitaryFacilities = $accessibilityForPeopleReducedMobilityToSanitaryFacilities;
    }

    /**
     * @return string|null
     */
    public function getAccessibilityToTheStandsForPeopleReducedMobility(): ?string
    {
        return $this->accessibilityToTheStandsForPeopleReducedMobility;
    }

    /**
     * @param string|null $accessibilityToTheStandsForPeopleReducedMobility
     */
    public function setAccessibilityToTheStandsForPeopleReducedMobility(?string $accessibilityToTheStandsForPeopleReducedMobility): void
    {
        $this->accessibilityToTheStandsForPeopleReducedMobility = $accessibilityToTheStandsForPeopleReducedMobility;
    }

    /**
     * @return string|null
     */
    public function getAccessibilityToPersonsReducedMobilityInLockerRooms(): ?string
    {
        return $this->accessibilityToPersonsReducedMobilityInLockerRooms;
    }

    /**
     * @param string|null $accessibilityToPersonsReducedMobilityInLockerRooms
     */
    public function setAccessibilityToPersonsReducedMobilityInLockerRooms(?string $accessibilityToPersonsReducedMobilityInLockerRooms): void
    {
        $this->accessibilityToPersonsReducedMobilityInLockerRooms = $accessibilityToPersonsReducedMobilityInLockerRooms;
    }

    /**
     * @return string|null
     */
    public function getPartialOrTotalAccessibilityForPeopleSensoryDisabilities(): ?string
    {
        return $this->partialOrTotalAccessibilityForPeopleSensoryDisabilities;
    }

    /**
     * @param string|null $partialOrTotalAccessibilityForPeopleSensoryDisabilities
     */
    public function setPartialOrTotalAccessibilityForPeopleSensoryDisabilities(?string $partialOrTotalAccessibilityForPeopleSensoryDisabilities): void
    {
        $this->partialOrTotalAccessibilityForPeopleSensoryDisabilities = $partialOrTotalAccessibilityForPeopleSensoryDisabilities;
    }

    /**
     * @return string|null
     */
    public function getAccessibilityForPeopleSensoryDisabilitiesToSanitaryFacilities(): ?string
    {
        return $this->accessibilityForPeopleSensoryDisabilitiesToSanitaryFacilities;
    }

    /**
     * @param string|null $accessibilityForPeopleSensoryDisabilitiesToSanitaryFacilities
     */
    public function setAccessibilityForPeopleSensoryDisabilitiesToSanitaryFacilities(?string $accessibilityForPeopleSensoryDisabilitiesToSanitaryFacilities): void
    {
        $this->accessibilityForPeopleSensoryDisabilitiesToSanitaryFacilities = $accessibilityForPeopleSensoryDisabilitiesToSanitaryFacilities;
    }

    /**
     * @return string|null
     */
    public function getAccessibilityToTheStandsForPeopleSensoryDisabilities(): ?string
    {
        return $this->accessibilityToTheStandsForPeopleSensoryDisabilities;
    }

    /**
     * @param string|null $accessibilityToTheStandsForPeopleSensoryDisabilities
     */
    public function setAccessibilityToTheStandsForPeopleSensoryDisabilities(?string $accessibilityToTheStandsForPeopleSensoryDisabilities): void
    {
        $this->accessibilityToTheStandsForPeopleSensoryDisabilities = $accessibilityToTheStandsForPeopleSensoryDisabilities;
    }

    /**
     * @return string|null
     */
    public function getAccessibilityToPersonsSensoryDisabilitiesInLockerRooms(): ?string
    {
        return $this->accessibilityToPersonsSensoryDisabilitiesInLockerRooms;
    }

    /**
     * @param string|null $accessibilityToPersonsSensoryDisabilitiesInLockerRooms
     */
    public function setAccessibilityToPersonsSensoryDisabilitiesInLockerRooms(?string $accessibilityToPersonsSensoryDisabilitiesInLockerRooms): void
    {
        $this->accessibilityToPersonsSensoryDisabilitiesInLockerRooms = $accessibilityToPersonsSensoryDisabilitiesInLockerRooms;
    }

    /**
     * @return string|null
     */
    public function getLengthOfTheBasin(): ?string
    {
        return $this->lengthOfTheBasin;
    }

    /**
     * @param string|null $lengthOfTheBasin
     */
    public function setLengthOfTheBasin(?string $lengthOfTheBasin): void
    {
        $this->lengthOfTheBasin = $lengthOfTheBasin;
    }

    /**
     * @return string|null
     */
    public function getWidthOfTheBasin(): ?string
    {
        return $this->widthOfTheBasin;
    }

    /**
     * @param string|null $widthOfTheBasin
     */
    public function setWidthOfTheBasin(?string $widthOfTheBasin): void
    {
        $this->widthOfTheBasin = $widthOfTheBasin;
    }

    /**
     * @return string|null
     */
    public function getBasinSurface(): ?string
    {
        return $this->basinSurface;
    }

    /**
     * @param string|null $basinSurface
     */
    public function setBasinSurface(?string $basinSurface): void
    {
        $this->basinSurface = $basinSurface;
    }

    /**
     * @return string|null
     */
    public function getMinimumBasinDepth(): ?string
    {
        return $this->minimumBasinDepth;
    }

    /**
     * @param string|null $minimumBasinDepth
     */
    public function setMinimumBasinDepth(?string $minimumBasinDepth): void
    {
        $this->minimumBasinDepth = $minimumBasinDepth;
    }

    /**
     * @return string|null
     */
    public function getMaximumBasinDepth(): ?string
    {
        return $this->maximumBasinDepth;
    }

    /**
     * @param string|null $maximumBasinDepth
     */
    public function setMaximumBasinDepth(?string $maximumBasinDepth): void
    {
        $this->maximumBasinDepth = $maximumBasinDepth;
    }

    /**
     * @return string|null
     */
    public function getTrackLength(): ?string
    {
        return $this->trackLength;
    }

    /**
     * @param string|null $trackLength
     */
    public function setTrackLength(?string $trackLength): void
    {
        $this->trackLength = $trackLength;
    }

    /**
     * @return string|null
     */
    public function getTypeOfUse(): ?string
    {
        return $this->typeOfUse;
    }

    /**
     * @param string|null $typeOfUse
     */
    public function setTypeOfUse(?string $typeOfUse): void
    {
        $this->typeOfUse = $typeOfUse;
    }

    /**
     * @return string|null
     */
    public function getNameOfBuilding(): ?string
    {
        return $this->nameOfBuilding;
    }

    /**
     * @param string|null $nameOfBuilding
     */
    public function setNameOfBuilding(?string $nameOfBuilding): void
    {
        $this->nameOfBuilding = $nameOfBuilding;
    }

    /**
     * @return string|null
     */
    public function getTypeOfUsers(): ?string
    {
        return $this->typeOfUsers;
    }

    /**
     * @param string|null $typeOfUsers
     */
    public function setTypeOfUsers(?string $typeOfUsers): void
    {
        $this->typeOfUsers = $typeOfUsers;
    }

    /**
     * @return string|null
     */
    public function getTypeOfSoil(): ?string
    {
        return $this->typeOfSoil;
    }

    /**
     * @param string|null $typeOfSoil
     */
    public function setTypeOfSoil(?string $typeOfSoil): void
    {
        $this->typeOfSoil = $typeOfSoil;
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