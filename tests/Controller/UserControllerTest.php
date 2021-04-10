<?php


namespace App\Tests\Controller;


use App\Tests\Tools\GetClientWithLoggedUser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    private $client;

    public function setUp(): void
    {
        $this->client = new GetClientWithLoggedUser();
    }

    public function testAccesDeniedIfNotAdmin()
    {
        $client = $this->client->getUser();

        //
        $client->request('GET', '/users/1/edit');
        $this->assertResponseStatusCodeSame(403);

        //
        $client->request('GET', '/users');
        $this->assertResponseStatusCodeSame(403);
    }

    public function testUsersList()
    {
        $client = $this->client->getAdmin();

        $crawler = $client->request('GET', '/users');

        self::assertStringContainsString('<a href="/users/1/edit"', $crawler->outerHtml());
        self::assertStringContainsString('<a href="/users/2/edit"', $crawler->outerHtml());
        self::assertStringContainsString('<a href="/users/3/edit"', $crawler->outerHtml());
    }

    public function testEditUser()
    {
        $client = $this->client->getAdmin();

        //
        $crawler = $client->request('GET', '/users');
        self::assertStringContainsString('<td>azerty@gmail.com</td>', $crawler->outerHtml());
        self::assertStringNotContainsString('ROLE_ADMIN, ROLE_USER', $crawler->filter('td.test-selector')->first()->outerHtml());


        //
        $crawler = $client->request('GET', '/users/1/edit');

        $form = $crawler->selectButton('Modifier')->form();
        $form['registration_form[email]'] = 'azertiti@gmail.com';
        $form['registration_form[password][first]'] = 'azerty';
        $form['registration_form[password][second]'] = 'azerty';
        $form['registration_form[username]'] = 'azerty';
        $form['registration_form[role]'] = 'ROLE_ADMIN';

        $client->submit($form);
        $crawler = $client->followRedirect();
        self::assertStringContainsString('<td>azertiti@gmail.com</td>', $crawler->outerHtml());
        self::assertStringContainsString('ROLE_ADMIN, ROLE_USER', $crawler->filter('td.test-selector')->first()->outerHtml());
    }
}