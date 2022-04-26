<?php

namespace App\Controller\Api;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * Method to get the list of all categories
     * @Route("/api/category", name="api_category", methods={"GET"})
     * @return Response
     */
    public function categoriesList(CategoryRepository $categoryRepository): Response
    {
        $categoriesList = $categoryRepository->findAll();

        return $this->json(
            $categoriesList,
            Response::HTTP_OK,
            [],
            [
                'groups' => 'api_categories_list'
            ]
        );
    }

    /**
     * Method to get a category information using it's id
     * @Route("/api/category/{id}", name="api_category_by_id", requirements={"id"="\d+"}, methods={"GET"})
     * @return Response
     */
    public function categoryById(Category $category = null): Response
    {
        // if the id doesn't correspond to any category
        if (is_null($category)) {
            return $this->json(['error' => 'categorie non trouvée.'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($category, Response::HTTP_OK, [], ['groups' => 'get_category_by_id']);
    }
}
