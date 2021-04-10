<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TaskAndUserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public static $tasks = [
        'Sortir les poubelles' => 'Bien penser à trier le verre',
        'Passer l\'aspirateur' => 'Dans la chambre et le couloir',
        'Faire les courses' => 'Ne pas oublier le beurre',
        'Payer le loyer' => 'Verifier que les charges sont comprises ce mois ci',
    ];

    public function load(ObjectManager $manager)
    {
        $users = ['azerty', 'admin', 'kasskq', 'noob'];

        foreach ($users as $username) {

            $user = new User();
            $user->setEmail($username . '@gmail.com')
                ->setUsername($username)
                ->setPassword(
                    $this->passwordEncoder->encodePassword(
                        $user,
                        'azerty'
                    )
                );
            $manager->persist($user);
        }

        $count = 0;
        foreach (self::$tasks as $title => $content) {


            $task = new Task();
            $task->setTitle($title);
            $task->setContent($content);
            if ($count < 2) {
                $task->setUser($user);
            }
            $manager->persist($task);
            $count++;
        }
        $manager->flush();
    }
}
