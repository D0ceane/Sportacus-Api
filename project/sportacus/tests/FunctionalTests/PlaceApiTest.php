<?php

namespace FunctionalTests;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class PlaceApiTest extends \ApiPlatform\Symfony\Bundle\Test\ApiTestCase
{
    use RefreshDatabaseTrait;

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     */
    public function testGetCollectionOfPlaceApi(): void
    {
        $response = static::createClient()->request('GET', '/api/place-api');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertCount(1, $response->toArray()['hydra:member']);

    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testCreatePlaceApi()
    {
        self::createClient()->request('POST', '/api/created-place-api', ['json' => [
            'installationNumber' => 'My installation number',
            'installationName' => 'My installation name',
            'adresse' => 'My address',
            'typequipement' => 'A type',
            'postalCode' => '75001',
            'commune' => 'Paris'
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }
}