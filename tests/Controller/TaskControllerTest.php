<?php


namespace App\Tests\Controller;


use App\Tests\Tools\GetClientWithLoggedUser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    private $client;

    public function setUp(): void
    {
        $this->client = new GetClientWithLoggedUser();
    }

    public function testTaskDoneTodoAndDelete()
    {
        //
        $tasks = self::getTodoAndDoneTasksCount();

        self::assertEquals(4, $tasks['todo']);
        self::assertEquals(0, $tasks['done']);

        //
        $button = 'button:contains("Supprimer")';
        $tasks = self::getTodoAndDoneTasksCount($button);

        self::assertEquals(3, $tasks['todo']);
        self::assertEquals(0, $tasks['done']);

        //
        $button = 'button:contains("Marquer comme faite")';
        $tasks = self::getTodoAndDoneTasksCount($button);

        self::assertEquals(2, $tasks['todo']);
        self::assertEquals(1, $tasks['done']);

        //
        $button = 'button:contains("Marquer non terminée")';
        $tasks = self::getTodoAndDoneTasksCount($button);

        self::assertEquals(3, $tasks['todo']);
        self::assertEquals(0, $tasks['done']);
    }

    public function getTodoAndDoneTasksCount($button = null, $form = null)
    {

        self::ensureKernelShutdown();
        $client = $this->client->getUser();
        $crawler = $client->request('GET', '/tasks');

        if ($button) {
            $form = $crawler->filter($button)->form([], 'POST');
            $client->submit($form);
            $crawler = $client->followRedirect();
        }

        $tasksTodo = count($crawler->filter('span.glyphicon-remove'));
        $tasksDone = count($crawler->filter('span.glyphicon-ok'));

        return [
            'todo' => $tasksTodo,
            'done' => $tasksDone,
        ];
    }

    public function testCreateTask()
    {

        $client = $this->client->getUser();

        $crawler = $client->request('GET', '/tasks/create');

        $form = $crawler->selectButton('Ajouter')->form();

        $form['task[title]'] = 'title';
        $form['task[content]'] = 'content';

        $client->submit($form);
        $crawler = $client->followRedirect();

        $tasksTodo = count($crawler->filter('span.glyphicon-remove'));
        $tasksDone = count($crawler->filter('span.glyphicon-ok'));

        self::assertEquals(0, $tasksDone);
        self::assertEquals(5, $tasksTodo);
    }

    public function testEditTask()
    {
        $client = $this->client->getUser();

        //
        $crawler = $client->request('GET', '/tasks');

        self::assertStringContainsString('<a href="/tasks/1/edit">Sortir les poubelles</a>', $crawler->outerHtml());
        self::assertStringContainsString('<p>Bien penser à trier le verre</p>', $crawler->outerHtml());
        self::assertStringNotContainsString('<a href="/tasks/1/edit">New title</a>', $crawler->outerHtml());
        self::assertStringNotContainsString('<p>New content</p>', $crawler->outerHtml());

        //
        $crawler = $client->request('GET', '/tasks/1/edit');

        $form = $crawler->selectButton('Modifier')->form();
        $form['task[title]'] = 'New title';
        $form['task[content]'] = 'New content';

        $client->submit($form);
        $crawler = $client->followRedirect();

        self::assertStringNotContainsString('<a href="/tasks/1/edit">Sortir les poubelles</a>', $crawler->outerHtml());
        self::assertStringNotContainsString('<p>Bien penser à trier le verre</p>', $crawler->outerHtml());
        self::assertStringContainsString('<a href="/tasks/1/edit">New title</a>', $crawler->outerHtml());
        self::assertStringContainsString('<p>New content</p>', $crawler->outerHtml());
    }

    public function testNotLoggedRedirect()
    {
        $urls = [
            '/tasks',
            '/tasks/create',
            '/tasks/1/edit',
        ];
        $client = static::createClient();

        foreach ($urls as $url) {
            $client->request('GET', $url);
            $this->assertResponseRedirects('/login');
        }
    }
}