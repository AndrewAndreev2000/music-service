<?php

namespace App\DTO\User;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserDTO
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Email]
        public string $email,

        #[Assert\NotBlank]
        public string $password,

        #[Assert\NotBlank]
        public string $name,

        public array $roles
    ) {
    }
}
