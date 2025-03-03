<?php

namespace App\DTO\Album;

use Symfony\Component\Validator\Constraints as Assert;

class CreateAlbumDTO
{
    public function __construct(
        #[Assert\NotBlank]
        public string $name,

        #[Assert\NotBlank]
        public string $description
    ) {
    }
}
