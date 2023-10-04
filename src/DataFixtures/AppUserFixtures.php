<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class AppUserFixtures extends Fixture
{
    private $passwordHasher;
    // injecter une dépendance
    public function __construct(UserPasswordHasherInterface $passwordHasherInterface)
    {
        $this->passwordHasher = $passwordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('user@oflix.com');
        
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'user');
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_USER']);

        $manager->persist($user);

        $managerUser = new User();
        $managerUser->setEmail('manager@oflix.com');
        $hashedPassword = $this->passwordHasher->hashPassword($managerUser, 'manager');
        $managerUser->setPassword($hashedPassword);
        $managerUser->setRoles(['ROLE_MANAGER']);

        $manager->persist($managerUser);

        $adminUser = new User();
        $adminUser->setEmail('admin@oflix.com');
        $hashedPassword = $this->passwordHasher->hashPassword($adminUser, 'admin');
        $adminUser->setPassword($hashedPassword);
        $adminUser->setRoles(['ROLE_ADMIN']);

        $manager->persist($adminUser);

        $manager->flush();
    }
}