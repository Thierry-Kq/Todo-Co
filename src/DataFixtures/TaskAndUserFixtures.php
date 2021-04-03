<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaskAndUserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $task = new Task();

        $task->setContent('azerty');
        $task->setTitle('azertyaze');

        // $product = new Product();
        $manager->persist($task);

        $manager->flush();
    }
}
