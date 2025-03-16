<?php

namespace App\Controller;

use App\DTO\Concert\CreateConcertDTO;
use App\Entity\Concert\Manager\ConcertManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

#[Route('/api/concert')]
class ConcertCrudController extends AbstractController
{
    public function __construct(
        private readonly TokenStorageInterface $token,
        private readonly ConcertManager $manager,
    ) {
    }

    #[Route('/', name: 'app_concert_index')]
    public function indexAction(): JsonResponse
    {
        $user = $this->getUser();

        return new JsonResponse(['concerts' => $this->manager->getConcerts($user)]);
    }

    #[Route('/create', name: 'app_concert_create', methods: ['POST'])]
    public function createAction(#[MapRequestPayload] CreateConcertDTO $createConcertDTO): JsonResponse
    {
        return new JsonResponse(['test' => 121212]);
    }
}
