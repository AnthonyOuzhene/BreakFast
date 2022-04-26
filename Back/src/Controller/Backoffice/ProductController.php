<?php

namespace App\Controller\Backoffice;

use App\Entity\Product;
use App\Entity\Tag;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_product_read", methods={"GET"})
     */
    public function read(ProductRepository $productRepository): Response
    {
        return $this->render('backoffice/product/read.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="app_backoffice_product_create", methods={"GET", "POST"})
     */
    public function create(Request $request, ProductRepository $productRepository): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->add($product);

            $this->addFlash('success', 'produit ajouté.');

            return $this->redirectToRoute('app_backoffice_product_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/product/create.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

     /**
     * @Route("/{id}", name="app_backoffice_product_show", methods={"GET"})
     */
    public function showWithTag(ProductRepository $productRepository, int $id): Response
    {
        $product = $productRepository->findOneByIdJoinedToTag($id);
        
        $tag = $product->getTag();

        return $this->render('backoffice/product/show.html.twig', [
            'product' => $product,
            'tags' => $tag
        ]);
    }

    // /**
    //  * @Route("/{id}", name="app_backoffice_product_show", methods={"GET"})
    //  */
    // public function show(Product $product): Response
    // {
    //     return $this->render('backoffice/product/show.html.twig', [
    //         'product' => $product,
    //     ]);
    // }

 
    /**
     * @Route("/{id}/update", name="app_backoffice_product_update", methods={"GET", "POST"})
     */
    public function update(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->add($product);

            $this->addFlash('success', 'produit modifié.');

            return $this->redirectToRoute('app_backoffice_product_read', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/product/update.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_product_delete", methods={"POST"})
     */
    public function delete(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $productRepository->remove($product);

            $this->addFlash('success', 'produit supprimé.');
        }

        return $this->redirectToRoute('app_backoffice_product_read', [], Response::HTTP_SEE_OTHER);
    }
}
