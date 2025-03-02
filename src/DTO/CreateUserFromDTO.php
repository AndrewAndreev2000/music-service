<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class CreateUserFromDTO
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Email]
        public string $email,

        #[Assert\NotBlank]
        public string $password,

        #[Assert\NotBlank]
        public string $name
    ) {
    }
}