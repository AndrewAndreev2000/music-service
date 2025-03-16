<?php

namespace App\Entity\Concert;

use App\Entity\Concert\Repository\ConcertRepository;
use App\Entity\User\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConcertRepository::class)]
#[ORM\Table(name: self::TABLE_NAME)]
class Concert
{
    public const TABLE_NAME = 'app_concert';

    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\Column(name: 'name', type: 'string', length: 255, nullable: false)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'concerts')]
    #[ORM\JoinColumn(name: 'artist_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?User $artist = null;

    #[ORM\Column(name: 'date', type: Types::DATETIME_MUTABLE, nullable: false)]
    protected ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
