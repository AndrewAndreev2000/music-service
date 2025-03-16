<?php

namespace App\Provider;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\User\UserInterface;

class UserStateChainProvider
{
    /**
     * @param iterable<UserStateProviderInterface> $providers
     */
    public function __construct(
        private iterable $providers = []
    ) {
    }

    /**
     * @return iterable<UserStateProviderInterface>
     */
    public function getProviders(): iterable
    {
        return $this->providers;
    }

    public function getState(?UserInterface $user, QueryBuilder $qb)
    {
        foreach ($this->getProviders() as $provider) {
            $qb = $provider->getState($qb);
        }

        return $qb;
    }
}
