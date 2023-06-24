<?php

namespace App\Tests\UnitTests;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use App\Entity\Sport;

class UnitSportTest extends \ApiPlatform\Symfony\Bundle\Test\ApiTestCase
{
    use RefreshDatabaseTrait;

    public function testSportName() {
        $sport = new Sport();
        $name = "nothing else matter";
        $sport->setNameSport($name);
        $this->assertEquals($name, $sport->getNameSport());
    }

    public function testGetId() {
        $sport = new Sport();
        $this->assertNull($sport->getId());
    }

    public function testCreatedAt() {
        $sport = new Sport();
        $dateTime = new \DateTimeImmutable();
        $sport->setCreatedAtSport($dateTime);
        $this->assertEquals($dateTime, $sport->getCreatedAtSport());
    }

}