<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/users/create');

        $form = $crawler->selectButton('Ajouter')->form();

        $form['registration_form[username]'] = 'userTest';
        $form['registration_form[email]'] = 'usertest@gmail.com';
        $form['registration_form[password][first]'] = 'azerty';
        $form['registration_form[password][second]'] = 'azerty';

        $client->submit($form);
        $crawler = $client->followRedirect();

        self::assertStringContainsString('<td>userTest</td>', $crawler->outerHtml());
        self::assertStringContainsString('<td>usertest@gmail.com</td>', $crawler->outerHtml());
    }

    public function testRegisterEmailAlreadyUsed()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/users/create');

        $form = $crawler->selectButton('Ajouter')->form();

        $form['registration_form[username]'] = 'userTest2';
        $form['registration_form[email]'] = 'azerty@gmail.com';
        $form['registration_form[password][first]'] = 'azerty';
        $form['registration_form[password][second]'] = 'azerty';

        $crawler = $client->submit($form);

        self::assertStringContainsString('<span class="form-error-message">This value is already used.</span>', $crawler->outerHtml());
    }
}