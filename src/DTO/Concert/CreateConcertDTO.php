<?php

namespace App\DTO\Concert;

use Symfony\Component\Validator\Constraints as Assert;

class CreateConcertDTO
{
    public function __construct(
        #[Assert\NotBlank]
        public string $name,

        #[Assert\NotBlank]
        public string $description
    ) {
    }
}
