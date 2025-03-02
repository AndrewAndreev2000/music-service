<?php

namespace App\Controller;

use App\Entity\Manager\UserManager;
use App\DTO\CreateUserFromDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    public function __construct(
        private readonly UserManager         $userManager,
        private readonly ValidatorInterface $validator,
        private readonly SerializerInterface $serializer
    ) {
    }

    #[Route('/api/register', name: 'app_register', methods: ['POST'])]
    public function registerAction(#[MapRequestPayload] CreateUserFromDTO $createUserFromDTO): JsonResponse
    {
        $errors = $this->validator->validate($createUserFromDTO);

        if (count($errors) > 0) {
            return new JsonResponse(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        try {
            $user = $this->userManager->createUserFromDto($createUserFromDTO);
            $user->setRoles(['ROLE_USER']);

            $this->userManager->saveUser($user);

            $serializedUser = $this->serializer->serialize($user, 'json');

            return new JsonResponse(['user' => json_decode($serializedUser)], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
        }
    }
}