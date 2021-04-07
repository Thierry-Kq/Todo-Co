<?php


namespace App\Tests\Controller;


use App\Tests\Tools\GetClientWithLoggedUser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    private $client;

    public function setUp(): void
    {
        $this->client = new GetClientWithLoggedUser();
    }

    public function testHomepage()
    {
        $client = $this->client->getUser();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}