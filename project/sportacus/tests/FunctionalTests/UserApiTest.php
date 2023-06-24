<?php

namespace App\Tests\FunctionalTests;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class UserApiTest extends \ApiPlatform\Symfony\Bundle\Test\ApiTestCase
{

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     */
    public function testGetCollectionOfUsers(): void
    {
        $response = static::createClient()->request('GET', '/api/get-users');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');

        $response->toArray()['hydra:member'];

    }

    /**
     * @throws TransportExceptionInterface
     */
    public function testCreateUser()
    {
        self::createClient()->request('POST', '/api/create-user', ['json' => [
            'email' => 'test1234@example.com',
            'plainPassword' => 'password123',
            'username' => 'usernametest',
        ]]);

        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }
}