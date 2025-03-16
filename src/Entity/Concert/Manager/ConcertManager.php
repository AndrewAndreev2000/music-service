<?php

namespace App\Entity\Concert\Manager;

use App\Entity\Concert\Concert;
use App\Entity\Concert\Repository\ConcertRepository;
use App\Provider\UserStateChainProvider;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ConcertManager
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserStateChainProvider $provider
    ) {
    }

    public function getConcerts(?UserInterface $user)
    {
        /** @var ConcertRepository $repository */
        $repository = $this->entityManager->getRepository(Concert::class);
        $baseQueryBuilder = $repository->getConcertsBaseQueryBuilder();
        $qb = $this->provider->getState($user, $baseQueryBuilder);

        return $qb->getQuery()->getResult(AbstractQuery::HYDRATE_ARRAY);
    }
}