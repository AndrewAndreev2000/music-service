<?php

namespace App\Entity;

use App\Bundle\HelpDeskBundle\Entity\Ticket;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: self::TABLE_NAME)]
class Album
{
    public const TABLE_NAME = 'app_album';

    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\Column(name: 'name', type: 'string', length: 255, nullable: false)]
    private ?string $name = null;

    #[ORM\Column(name: 'description', type: 'string', nullable: false)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'albums', targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'artist_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?User $artist = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->id;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getArtist(): ?User
    {
        return $this->artist;
    }

    public function setArtist(?User $artist): self
    {
        $this->artist = $artist;

        return $this;
    }
}
