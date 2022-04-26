<?php

namespace App\Controller\Backoffice;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/post")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_post_read", methods={"GET"})
     */
    public function read(PostRepository $postRepository): Response
    {
        return $this->render('backoffice/post/read.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="app_backoffice_post_create", methods={"GET", "POST"})
     */
    public function create(Request $request, PostRepository $postRepository): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postRepository->add($post);
            return $this->redirectToRoute('app_backoffice_post_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/post/create.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_post_show", methods={"GET"})
     */
    public function show(Post $post): Response
    {
        return $this->render('backoffice/post/show.html.twig', [
            'post' => $post,
        ]);
    }

    /**
     * @Route("/{id}/update", name="app_backoffice_post_update", methods={"GET", "POST"})
     */
    public function update(Request $request, Post $post, PostRepository $postRepository): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postRepository->add($post);
            return $this->redirectToRoute('app_backoffice_post_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/post/update.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_post_delete", methods={"POST"})
     */
    public function delete(Request $request, Post $post, PostRepository $postRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $postRepository->remove($post);
        }

        return $this->redirectToRoute('app_backoffice_post_read', [], Response::HTTP_SEE_OTHER);
    }
}
