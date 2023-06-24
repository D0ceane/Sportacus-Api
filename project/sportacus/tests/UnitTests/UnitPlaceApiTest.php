<?php

namespace App\Tests\UnitTests;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use App\Entity\PlaceApi;

class UnitPlaceApiTest extends \ApiPlatform\Symfony\Bundle\Test\ApiTestCase
{
    use RefreshDatabaseTrait;

    public function testEquipmentName() {
        $placeApi = new PlaceApi();
        $name = "unforgiven two";
        $placeApi->setEquipmentName($name);
        $this->assertEquals($name, $placeApi->getEquipmentName());
    }

    public function testGetId() {
        $placeApi = new PlaceApi();
        $this->assertNull($placeApi->getId());
    }

    public function testCoordgps() {
        $placeApi = new PlaceApi();
        $coordgpsx = "48";
        $coordgpsy = "2";
        $placeApi->setCoordgpsx($coordgpsx);
        $placeApi->setCoordgpsy($coordgpsy);
        $this->assertEquals($coordgpsx, $placeApi->getCoordgpsx());
        $this->assertEquals($coordgpsy, $placeApi->getCoordgpsy());
    }
}