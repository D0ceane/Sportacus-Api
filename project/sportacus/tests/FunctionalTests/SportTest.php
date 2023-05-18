<?php

namespace FunctionalTests;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class SportTest extends \ApiPlatform\Symfony\Bundle\Test\ApiTestCase
{
    use RefreshDatabaseTrait;

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     */
    public function testGetCollectionOfSport(): void
    {
        $response = static::createClient()->request('GET', '/api/sports');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $this->assertCount(1, $response->toArray()['hydra:member']);

    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testCreateSport()
    {
        self::createClient()->request('POST', '/api/sports', ['json' => [
            'nameSport' => 'My name',
            'typeSport' => 'collectif',
            'playerMaxSport' => 28,
            'createdAtSport' => '1985-07-31T00:00:00+00:00',
            'updatedAtSport' => '1985-07-31T00:00:00+00:00'
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }
}