<?php

namespace App\Entity\Manager;

use App\DTO\CreateUserFromDTO;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager
{
    public function __construct(
        private readonly ManagerRegistry $managerRegistry,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function createUserFromDto(CreateUserFromDTO $createUserFromDTO): User
    {
        $existingUser = $this->managerRegistry->getRepository(User::class)->findOneBy(['email' => $createUserFromDTO->email]);

        if ($existingUser) {
            throw new \DomainException('User with this email already exists');
        }

        $user = new User();
        $user->setEmail($createUserFromDTO->email);

        $hashedPassword = $this->passwordHasher->hashPassword($user, $createUserFromDTO->password);

        $user->setPassword($hashedPassword);

        return $user;
    }

    public function saveUser(User $user): void
    {
        $em = $this->managerRegistry->getManager();
        $em->persist($user);
        $em->flush();
    }
}