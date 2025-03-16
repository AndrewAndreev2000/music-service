<?php

namespace App\Provider;

use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class UserHasFavoriteGenresStateProvider implements UserStateProviderInterface
{

    public function __construct(
        private readonly ManagerRegistry $managerRegistry
    ) {
    }

    public function isApplicable(): bool
    {
        return true;
    }

    public function getState(QueryBuilder $qb)
    {
        $qb
            ->join('concert.artist', 'artist')
            ->join('artist.genres', 'artist');

        return $qb;
    }
}
