<?php

namespace App\Tests\Unit\Entity\Concert;

use App\Entity\Concert\Concert;
use App\Entity\User\User;
use PHPUnit\Framework\TestCase;

class ConcertTest extends TestCase
{
    public function testProperties(): void
    {
        $concert = new Concert();

        self::assertNull($concert->getId());

        self::assertNull($concert->getName());
        $concert->setName('Test Name');
        self::assertSame('Test Name', $concert->getName());

        self::assertNull($concert->getArtist());

        $user = new User();
        $user->setName('Test User');
        $concert->setArtist($user);
        self::assertSame('Test User', (string) $concert->getArtist());

        self::assertNull($concert->getDate());
        $concert->setDate(new \DateTime('2020-01-01'));
        self::assertSame('2020-01-01 00:00:00.000000', $concert->getDate());
    }
}