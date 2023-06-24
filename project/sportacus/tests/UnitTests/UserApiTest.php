<?php
namespace App\Tests\UnitTests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserApiTest extends TestCase
{
    public function testEmail()
    {
        $user = new User();
        $email = 'test@example.com';
        $user->setEmail($email);
        $this->assertEquals($email, $user->getEmail());
    }

    public function testRoles()
    {
        $user = new User();
        $roles = ['ROLE_USER', 'ROLE_ADMIN'];
        $user->setRoles($roles);
        $this->assertEquals($roles, $user->getRoles());
    }

    public function testPassword()
    {
        $user = new User();
        $password = 'password123';
        $user->setPassword($password);
        $this->assertEquals($password, $user->getPassword());
    }

    public function testUsername()
    {
        $user = new User();
        $username = 'username1234';
        $user->setUsername($username);
        $this->assertEquals($username, $user->getUsername());
    }
    public function testFirstname()
    {
        $user = new User();
        $firstName = 'TestFirstName';
        $user->setFirstName($firstName);
        $this->assertEquals($firstName, $user->getFirstName());
    }
    public function testLastname()
    {
        $user = new User();
        $lastName = 'TestFirstName';
        $user->setLastName($lastName);
        $this->assertEquals($lastName, $user->getLastName());
    }
    public function testProfilePicture()
    {
        $user = new User();
        $profilepicture = 'TestFirstName';
        $user->setProfilePicture($profilepicture);
        $this->assertEquals($profilepicture, $user->getProfilePicture());
    }

    public function testIsVerified()
    {
        $user = new User();
        $this->assertFalse($user->isVerified());

        $user->setIsVerified(true);
        $this->assertTrue($user->isVerified());
    }
}