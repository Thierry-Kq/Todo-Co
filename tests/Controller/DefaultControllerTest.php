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

    public function testHomepageLogged()
    {
        $client = $this->client->getUser();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testHomepageNotLogged()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertResponseRedirects('/login');
    }
}