<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Student;
use App\Entity\User;

class UserRepository extends ServiceEntityRepository {
    private $manager;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    ) {
        parent::__construct($registry, User::class);
        $this->manager = $manager;
    }

    public function saveUser(
        string $login,
        string $password,
        ?Student $student
    ) {
        $user = new User();
        $user->setLogin($login);
        $user->setPassword($password);
        $user->setProfile($student);

        $this->manager->persist($user);
        $this->manager->flush();
        return $user;
    }

    public function removeUser(User $user) {
        $this->manager->remove($user);
        $this->manager->flush();
    }

    public function updateUser(User $user) {
        $this->manager->persist($user);
        $this->manager->flush();

        return $job;
    }
}