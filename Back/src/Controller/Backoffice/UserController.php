<?php

namespace App\Controller\Backoffice;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_user_read", methods={"GET"})
     */
    public function read(UserRepository $userRepository): Response
    {
        return $this->render('backoffice/user/read.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="app_backoffice_user_create", methods={"GET", "POST"})
     */
    public function create(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hashedPassword = $userPasswordHasher->hashPassword($user, $user->getPassword());
            // On écrase le mot de passe en clair par le mot de passe haché
            $user->setPassword($hashedPassword);

            $userRepository->add($user);

            $this->addFlash('success', 'utilisateur ajouté.');

            return $this->redirectToRoute('app_backoffice_user_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/user/create.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('backoffice/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/update", name="app_backoffice_user_update", methods={"GET", "POST"})
     */
    public function update(Request $request, User $user, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Gestion du mot de passe modifié ou non
            // On va le chercher directement dans le formulaire car non mappé sur l'entité
            if ($form->get('password')->getData()) {
                // Si oui, on hache le nouveau mot de passe
                $hashedPassword = $userPasswordHasher->hashPassword($user, $form->get('password')->getData());
                // On écrase le mot de passe en clair par le mot de passe haché
                $user->setPassword($hashedPassword);
            }

            $userRepository->add($user);

            $this->addFlash('success', 'utilisateur modifié.');

            return $this->redirectToRoute('app_backoffice_user_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/user/update.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        $this->addFlash('success', 'utilisateur supprimé.');

        return $this->redirectToRoute('app_backoffice_user_read', [], Response::HTTP_SEE_OTHER);
    }
}
