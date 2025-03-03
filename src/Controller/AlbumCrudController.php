<?php

namespace App\Controller;

use App\DTO\Album\CreateAlbumDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\SwitchUserToken;

#[Route('/api/album')]
class AlbumCrudController extends AbstractController
{
    public function __construct(
        private readonly SwitchUserToken $token
    ) {
    }

    #[Route('/', name: 'app_album_index')]
    public function indexAction(): JsonResponse
    {
        return new JsonResponse(['test' => '12121212']);
    }

    #[Route('/create', name: 'app_album_create', methods: ['POST'])]
    public function createAction(#[MapRequestPayload] CreateAlbumDTO $createAlbumDTO): JsonResponse
    {
        return new JsonResponse(['test' => $this->token]);
    }
}