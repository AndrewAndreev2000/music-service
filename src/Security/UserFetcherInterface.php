<?php

namespace App\Security;

interface UserFetcherInterface
{
    public function getAuthUser(): AuthUserInterface;
}