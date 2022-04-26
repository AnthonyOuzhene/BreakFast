<?php

namespace App\Controller\Backoffice;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/category")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_category_read", methods={"GET"})
     */
    public function read(CategoryRepository $categoryRepository): Response
    {
        return $this->render('backoffice/category/read.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="app_backoffice_category_create", methods={"GET", "POST"})
     */
    public function create(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->add($category);

            $this->addFlash('success', 'catégorie ajoutée.');

            return $this->redirectToRoute('app_backoffice_category_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/category/create.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_category_show", methods={"GET"})
     */
    public function show(Category $category): Response
    {
        return $this->render('backoffice/category/show.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/{id}/update", name="app_backoffice_category_update", methods={"GET", "POST"})
     */
    public function update(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->add($category);

            $this->addFlash('success', 'catégorie modifiée.');

            return $this->redirectToRoute('app_backoffice_category_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/category/update.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_category_delete", methods={"POST"})
     */
    public function delete(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $categoryRepository->remove($category);
        }

        $this->addFlash('success', $category->getName() . ', supprimé.');

        return $this->redirectToRoute('app_backoffice_category_read', [], Response::HTTP_SEE_OTHER);
    }
}
