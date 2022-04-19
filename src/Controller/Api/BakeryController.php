<?php

namespace App\Controller\Api;

use App\Entity\Bakery;
use App\Repository\BakeryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;

class BakeryController extends AbstractController
{
    /**
     * Get the list of all bakeries
     * @Route("/api/bakery", name="api_bakery", methods={"GET"})
     * 
     * @OA\Response(
     *     response=200,
     *     description="Returns list of all bakeries",
     *  @Model(type=Bakery::class, groups={"get_bakeries_list"})
     * )
     * 
     * @return Response
     */
    public function bakeryList(BakeryRepository $bakeryRepository): Response
    {
        $bakeryList = $bakeryRepository->findAll();

        return $this->json(
            $bakeryList,
            Response::HTTP_OK,
            [],
            ['groups' => 'get_bakeries_list']
        );
    }

    /**
     * Method to get a bakery information using it's id
     * @Route("/api/bakery/{id<\d+>}", name="api_bakery_by_id", methods={"GET"})
     * @return Response
     */
    public function bakeryById(Bakery $bakery = null): Response
    {
        // if the id doesn't correspond to any bakery
        if ($bakery === null) {
            return $this->json(['error' => 'Boulangerie non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($bakery, Response::HTTP_OK, [], ['groups' => 'get_bakery_by_id']);
    }
}
