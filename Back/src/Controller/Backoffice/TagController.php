<?php

namespace App\Controller\Backoffice;

use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/tag")
 */
class TagController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_tag_read", methods={"GET"})
     */
    public function read(TagRepository $tagRepository): Response
    {
        return $this->render('backoffice/tag/read.html.twig', [
            'tags' => $tagRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="app_backoffice_tag_create", methods={"GET", "POST"})
     */
    public function create(Request $request, TagRepository $tagRepository): Response
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tagRepository->add($tag);
            return $this->redirectToRoute('app_backoffice_tag_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/tag/create.html.twig', [
            'tag' => $tag,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_tag_show", methods={"GET"})
     */
    public function show(Tag $tag): Response
    {
        return $this->render('backoffice/tag/show.html.twig', [
            'tag' => $tag,
        ]);
    }

    /**
     * @Route("/{id}/update", name="app_backoffice_tag_update", methods={"GET", "POST"})
     */
    public function update(Request $request, Tag $tag, TagRepository $tagRepository): Response
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tagRepository->add($tag);
            return $this->redirectToRoute('app_backoffice_tag_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/tag/update.html.twig', [
            'tag' => $tag,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_tag_delete", methods={"POST"})
     */
    public function delete(Request $request, Tag $tag, TagRepository $tagRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tag->getId(), $request->request->get('_token'))) {
            $tagRepository->remove($tag);
        }

        return $this->redirectToRoute('app_backoffice_tag_read', [], Response::HTTP_SEE_OTHER);
    }
}
