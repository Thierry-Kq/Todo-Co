<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    public function testAllRouteOnce()
    {
        $client = static::createClient();

        $client->request('GET', '/tasks');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $client->request('GET', '/tasks/create');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // todo :
//        $client->request('GET', '/tasks/{id}/edit');
//        $client->request('GET', '/tasks/{id}/toggle');
//        $client->request('GET', '/tasks/{id}/delete');

    }
}