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
                'PHP_AUTH_USER' => 'admin',
                'PHP_AUTH_PW' => 'azerty',
            ]
        );
    }
}