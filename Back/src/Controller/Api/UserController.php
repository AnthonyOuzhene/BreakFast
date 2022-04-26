<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Response\JsonErrorResponse;
use Doctrine\Migrations\Configuration\EntityManager\ManagerRegistryEntityManager;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\JsonDecoder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    /**
     * Creates a user
     * @Route("/api/user", name="api_user_create", methods="POST")
     * @return Response
     */
    public function newUser(ManagerRegistry $doctrine,  UserPasswordHasherInterface $hasher, Request $request, UserRepository $userRepository, SerializerInterface $serializer): Response
    {
        // récupérer les données depuis la requete
        $userAsJson = $request->getContent();

        /** @var User $user */
        $user = $serializer->deserialize($userAsJson, User::class, JsonEncoder::FORMAT);

        $hashedPassword = $hasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);

        // enregistrer le user en BDD
        $entityManager = $doctrine->getManager();

        $entityManager->persist($user);

        $entityManager->flush();

        $data = [
            'id' => $user->getId(),
        ];

        return $this->json($data, Response::HTTP_CREATED);
    }

    /**
     * Get a user details
     * @Route("/api/user/{id}", name="api_user_read", methods="GET", requirements={"id"="\d+"})
     * @return Response
     */
    public function userById(User $user, int $id, UserRepository $userRepository): Response
    {
        if (! $this->isGranted("ROLE_USER"))
        {
            $data = 
            [
                'error' => true,
                'msg' => 'Il faut être connecté pour accéder à cette page.'
            ];
            return $this->json($data, Response::HTTP_FORBIDDEN);
        }

        $this->denyAccessUnlessGranted('PROFILE_VIEW', $user);

        // préparer les données
        $user = $userRepository->find($id);

        if (is_null($user))
        {
            $data = 
            [
                'error' => true,
                'message' => 'User not found',
            ];
            return $this->json($data, Response::HTTP_NOT_FOUND, [], ['groups' => "api_user"]);
        }

        return $this->json($user, Response::HTTP_OK, [], ['groups' => "api_user"]);
    }
    
    /**
     * @IsGranted("ROLE_ADMIN")
     * Method to get a list of all users
     * @Route("/api/user", name="api_user_list", methods="GET")
     * @return Response
     */
    public function userList(UserRepository $userRepository): Response
    {
        
        // préparer les données
        $userList = $userRepository->findAll();

        return $this->json($userList, Response::HTTP_OK, [], ['groups' => "api_user"]);
    }
}