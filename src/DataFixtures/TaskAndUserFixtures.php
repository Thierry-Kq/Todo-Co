<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaskAndUserFixtures extends Fixture
{

    public static $tasks = [
        'Sortir les poubelles' => 'Bien penser à trier le verre',
        'Passer l\'aspirateur' => 'Dans la chambre et le couloir',
        'Faire les courses' => 'Ne pas oublier le beurre',
        'Payer le loyer' => 'Verifier que les charges sont comprises ce mois ci',
    ];

    public function load(ObjectManager $manager)
    {

        foreach (self::$tasks as $title => $content) {

            $task = new Task();
            $task->setTitle($title);
            $task->setContent($content);

            $manager->persist($task);
        }

        $manager->flush();
    }
}
