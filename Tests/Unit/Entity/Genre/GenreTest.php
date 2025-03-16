<?php

namespace App\Tests\Unit\Entity\Genre;

use App\Entity\Genre\Genre;
use PHPUnit\Framework\TestCase;

class GenreTest extends TestCase
{
    public function testProperties(): void
    {
        $genre = new Genre();

        self::assertNull($genre->getId());

        self::assertNull($genre->getName());
        $genre->setName('Test Name');
        self::assertSame('Test Name', $genre->getName());
    }
}