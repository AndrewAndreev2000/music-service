<?php

namespace App\Entity;

use App\Bundle\HelpDeskBundle\Entity\Group;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: self::TABLE_NAME)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const TABLE_NAME = 'app_user';

    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\Column(name: 'email', type: Types::STRING, length: 255, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column(name: 'password', type: Types::STRING, length: 255)]
    #[Assert\NotBlank]
    private ?string $password = null;

    #[ORM\Column(type: Types::JSON)]
    private array $roles = [];

    #[ORM\OneToMany(targetEntity: Concert::class, mappedBy: 'artist', cascade: ['persist'])]
    protected ArrayCollection $concerts;

    #[ORM\ManyToMany(targetEntity: Genre::class)]
    #[ORM\JoinTable(name: 'app_user_genre')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'genre_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    protected ArrayCollection $genres;

    #[ORM\ManyToMany(targetEntity: Genre::class)]
    #[ORM\JoinTable(name: 'app_user_favorite_genre')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[ORM\InverseJoinColumn(name: 'favorite_genre_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    protected ArrayCollection $favoriteGenres;

    public function __construct()
    {
        $this->concerts = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->favoriteGenres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ORM\Column(name: 'name', type: 'string', length: 255, nullable: false)]
    protected ?string $name = null;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getConcerts(): Collection
    {
        return $this->concerts;
    }

    public function setConcerts(Collection $concerts): self
    {
        $this->concerts->clear();

        foreach ($concerts as $concert) {
            $this->addConcert($concert);
        }

        return $this;
    }

    public function addConcert(Concert $concert): self
    {
        if (!$this->concerts->contains($concert)) {
            $this->concerts->add($concert);
        }

        return $this;
    }

    public function removeConcerts(Concert $concert): self
    {
        if ($this->concerts->contains($concert)) {
            $this->concerts->removeElement($concert);
        }

        return $this;
    }

    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function setGenres(Collection $genres): self
    {
        $this->genres->clear();

        foreach ($genres as $genre) {
            $this->addGenre($genre);
        }

        return $this;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->genres->contains($genre)) {
            $this->genres->removeElement($genre);
        }

        return $this;
    }

    public function getFavoriteGenres(): Collection
    {
        return $this->favoriteGenres;
    }

    public function setFavoriteGenres(Collection $favoriteGenres): self
    {
        $this->favoriteGenres->clear();

        foreach ($favoriteGenres as $favoriteGenre) {
            $this->addFavoriteGenre($favoriteGenre);
        }

        return $this;
    }

    public function addFavoriteGenre(Genre $favoriteGenre): self
    {
        if (!$this->favoriteGenres->contains($favoriteGenre)) {
            $this->favoriteGenres->add($favoriteGenre);
        }

        return $this;
    }

    public function removeFavoriteGenre(Genre $favoriteGenre): self
    {
        if ($this->favoriteGenres->contains($favoriteGenre)) {
            $this->favoriteGenres->removeElement($favoriteGenre);
        }

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
    }
}
