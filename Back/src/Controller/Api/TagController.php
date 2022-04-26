<?php

namespace App\Controller\Api;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * Method to get the list of all categories
     * @Route("/api/tag", name="api_tag", methods={"GET"})
     * @return Response
     */
    public function tagList(TagRepository $tagRepository): Response
    {
        // On va chercher les données
        $tagList = $tagRepository->findAll();

        return $this->json(
            // Les données à sérialiser (à convertir en JSON)
            $tagList,
            // Le status code
            200,
            // Les en-têtes de réponse à ajouter (aucune)
            [],
            // Les groupes à utiliser par le Serializer
            ['groups' => 'get_tag_list']
        );
    }
    
    /**
     * Method to get a tag information using it's id
     * 
     * @Route("/api/tag/{id<\d+>}", name="api_tag_by_id", methods={"GET"})
     * @return Response
     */
    public function tagById(Tag $tag = null) :Response
    {
        // 404
        if ($tag === null) {
            return $this->json(['error' => 'Tag non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($tag, Response::HTTP_OK, [], ['groups' => 'get_tag_by_id']);
    }
}
