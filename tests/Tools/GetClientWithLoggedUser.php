<?php


namespace App\Tests\Tools;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetClientWithLoggedUser extends WebTestCase
{
    public function getUser()
    {
        return $client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'azerty',
                'PHP_AUTH_PW' => 'azerty',
            ]
        );
    }

    public function getAdmin()
    {
        return $client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'admin',
                'PHP_AUTH_PW' => 'azerty',
            ]
        );
    }

    public function getUserWithoutTask()
    {
        return $client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'userWithoutTask',
                'PHP_AUTH_PW' => 'azerty',
            ]
        );
    }

    public function getUserWithTask()
    {
        return $client = static::createClient(
            [],
            [
                'PHP_AUTH_USER' => 'noob',
                'PHP_AUTH_PW' => 'azerty',
            ]
        );
    }
}