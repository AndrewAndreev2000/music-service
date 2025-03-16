<?php

namespace App\Entity\Concert\Repository;

use App\Entity\Concert\Concert;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends EntityRepository<Concert>
 */
class ConcertRepository extends EntityRepository
{
    public function getConcertsBaseQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('concert');
    }
}