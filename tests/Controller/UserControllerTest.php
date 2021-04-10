<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testUsersList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/users');

        self::assertStringContainsString('<a href="/users/1/edit"', $crawler->outerHtml());
        self::assertStringContainsString('<a href="/users/2/edit"', $crawler->outerHtml());
        self::assertStringContainsString('<a href="/users/3/edit"', $crawler->outerHtml());
    }

    public function testEditUser()
    {
        $client = static::createClient();

        //
        $crawler = $client->request('GET', '/users');
        self::assertStringContainsString('<td>azerty@gmail.com</td>', $crawler->outerHtml());

        //
        $crawler = $client->request('GET', '/users/1/edit');

        $form = $crawler->selectButton('Modifier')->form();
        $form['registration_form[email]'] = 'azertiti@gmail.com';
        $form['registration_form[plainPassword]'] = 'azerty';
        $form['registration_form[username]'] = 'azerty';
        $form['registration_form[agreeTerms]'] = 1;

        $client->submit($form);
        $crawler = $client->followRedirect();
        self::assertStringContainsString('<td>azertiti@gmail.com</td>', $crawler->outerHtml());
    }
}