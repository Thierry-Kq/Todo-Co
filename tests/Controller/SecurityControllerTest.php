<?php


namespace App\Tests\Controller;


use App\Tests\Tools\GetClientWithLoggedUser;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
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
        $client->request('GET', '/users/create');
        $this->assertResponseStatusCodeSame(403);
        //
    }


    public function testRegister()
    {
        $client = $this->client->getAdmin();

        //
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
        self::assertStringNotContainsString('ROLE_ADMIN, ROLE_USER', $crawler->filter('td.test-selector')->last()->outerHtml());

        $crawler = $client->request('GET', '/users/create');
        $form = $crawler->selectButton('Ajouter')->form();

        $form['registration_form[username]'] = 'userTest2';
        $form['registration_form[email]'] = 'usertest2@gmail.com';
        $form['registration_form[password][first]'] = 'azerty';
        $form['registration_form[password][second]'] = 'azerty';
        $form['registration_form[role]'] = 'ROLE_ADMIN';

        $client->submit($form);
        $crawler = $client->followRedirect();

        self::assertStringContainsString('<td>userTest2</td>', $crawler->outerHtml());
        self::assertStringContainsString('<td>usertest2@gmail.com</td>', $crawler->outerHtml());
        self::assertStringContainsString('ROLE_ADMIN, ROLE_USER', $crawler->filter('td.test-selector')->last()->outerHtml());
    }

    public function testRegisterEmailAlreadyUsed()
    {
        $client = $this->client->getAdmin();
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