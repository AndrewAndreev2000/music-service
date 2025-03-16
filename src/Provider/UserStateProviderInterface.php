<?php

namespace App\Provider;


use Doctrine\ORM\QueryBuilder;

interface UserStateProviderInterface
{
    public function getState(QueryBuilder $qb);

    public function isApplicable(): bool;
}
