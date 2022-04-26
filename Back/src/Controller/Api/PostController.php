<?php

namespace App\Controller\Api;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * Method to get the list of all posts
     * @Route("/api/post", name="app_post", methods={"GET"})
     * @return Response
     */
    public function postList(PostRepository $postRepository): Response
    {
        $postList = $postRepository->findAll();

        return $this->json(
            $postList,
            Response::HTTP_OK,
            [],
            ['groups' => 'get_posts_list']
        );
    }

        /**
     * Method to get a post information using it's id
     * @Route("/api/post/{id<\d+>}", name="api_post_by_id", methods={"GET"})
     * @return Response
     */
    public function postById(Post $post = null) :Response
    {
        // if the id doesn't correspond to any post
        if ($post === null) {
            return $this->json(['error' => 'Article non trouvé.'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($post, Response::HTTP_OK, [], ['groups' => 'get_post_by_id']);
    }
}
