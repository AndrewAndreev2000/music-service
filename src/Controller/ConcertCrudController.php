<?php

namespace App\Controller;

use App\DTO\Concert\CreateConcertDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

#[Route('/api/concert')]
class ConcertCrudController extends AbstractController
{
    public function __construct(
        private readonly TokenStorageInterface $token
    ) {
    }

    #[Route('/', name: 'app_concert_index')]
    public function indexAction(): JsonResponse
    {
        return new JsonResponse(['test' => '12121212']);
    }

    #[Route('/create', name: 'app_concert_create', methods: ['POST'])]
    public function createAction(#[MapRequestPayload] CreateConcertDTO $createConcertDTO): JsonResponse
    {
        return new JsonResponse(['test' => 121212]);
    }
}
