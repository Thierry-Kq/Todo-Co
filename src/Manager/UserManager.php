<?php


namespace App\Manager;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{

    private $passwordEncoder;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function persistUser($form, $user)
    {
        if ($form->get('role')->getData() === 'ROLE_ADMIN') {
            $user->setRoles(['ROLE_ADMIN']);
        } else {
            $user->setRoles([]);
        }
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                $form->get('password')->getData()
            )
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}