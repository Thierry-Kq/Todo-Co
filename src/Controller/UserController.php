<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Manager\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="user_list")
     */
    public function listAction(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render(
            'user/index.html.twig',
            [
                'users' => $users,
            ]
        );
    }

    /**
     * @Route("/users/{id}/edit", name="user_edit")
     */
    public function editAction(
        User $user,
        Request $request,
        UserManager $userManager
    ) {
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userManager->persistUser($form, $user);
            $this->addFlash('success', "L'utilisateur a bien été modifié");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edit.html.twig', ['form' => $form->createView(), 'user' => $user]);
    }

}
