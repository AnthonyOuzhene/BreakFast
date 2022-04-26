<?php

namespace App\Controller\Backoffice;

use App\Entity\Bakery;
use App\Entity\User;
use App\Form\BakeryType;
use App\Repository\BakeryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/bakery")
 */
class BakeryController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_bakery_read", methods={"GET"})
     */
    public function read(BakeryRepository $bakeryRepository): Response
    {
        return $this->render('backoffice/bakery/read.html.twig', [
            'bakeries' => $bakeryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="app_backoffice_bakery_create", methods={"GET", "POST"})
     */
    public function create(Request $request, BakeryRepository $bakeryRepository): Response
    {
        $bakery = new Bakery();
        $form = $this->createForm(BakeryType::class, $bakery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bakeryRepository->add($bakery);

            $this->addFlash('success', 'boulangerie ajoutée.');

            return $this->redirectToRoute('app_backoffice_bakery_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/bakery/create.html.twig', [
            'bakery' => $bakery,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_bakery_show", methods={"GET"})
     */
    public function show(Bakery $bakery): Response
    {
        return $this->render('backoffice/bakery/show.html.twig', [
            'bakery' => $bakery,
        ]);
    }

    /**
     * @Route("/{id}/update", name="app_backoffice_bakery_update", methods={"GET", "POST"})
     */
    public function update(Request $request, Bakery $bakery, BakeryRepository $bakeryRepository): Response
    {
        $form = $this->createForm(BakeryType::class, $bakery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bakeryRepository->add($bakery);

            $this->addFlash('success', 'boulangerie modifiée.');

            return $this->redirectToRoute('app_backoffice_bakery_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/bakery/update.html.twig', [
            'bakery' => $bakery,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_bakery_delete", methods={"POST"})
     */
    public function delete(Request $request, Bakery $bakery, BakeryRepository $bakeryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bakery->getId(), $request->request->get('_token'))) {
            $bakeryRepository->remove($bakery);
        }

        $this->addFlash('success', 'boulangerie supprimée.');

        return $this->redirectToRoute('app_backoffice_bakery_read', [], Response::HTTP_SEE_OTHER);
    }
}
