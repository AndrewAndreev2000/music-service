<?php

namespace App\Entity\User\Manager;

use App\DTO\User\CreateUserDTO;
use App\Entity\User\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager
{
    public function __construct(
        private readonly ManagerRegistry $managerRegistry,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function createUserFromDto(CreateUserDTO $createUserFromDTO): User
    {
        $existingUser = $this->managerRegistry->getRepository(User::class)->findOneBy(['email' => $createUserFromDTO->email]);

        if (null !== $existingUser) {
            throw new \Exception('Пользователь с таким email уже существует');
        }

        $user = new User();
        $user->setEmail($createUserFromDTO->email);

        $hashedPassword = $this->passwordHasher->hashPassword($user, $createUserFromDTO->password);

        $user->setPassword($hashedPassword);
        $user->setName($createUserFromDTO->name);
        $user->setRoles($createUserFromDTO->roles);

        return $user;
    }

    public function saveUser(User $user): void
    {
        $em = $this->managerRegistry->getManager();
        $em->persist($user);
        $em->flush();
    }
}
