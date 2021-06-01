<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\School;

class SchoolRepository extends ServiceEntityRepository {
    
    private $manager;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    ) {
        parent::__construct($registry, School::class);
        $this->manager = $manager;
    }

    public function saveSchool(string $name, ?string $type) {
        $school = new School();
        $school->setName($name);
        $school->setType($type);

        $this->manager->persist($school);
        $this->manager->flush();
        return $school;
    }

    public function removeSchool(School $school) {
        $this->manager->remove($school);
        $this->manager->flush();
    }

    public function updateSchool(School $school) {
        $this->manager->persist($school);
        $this->manager->flush();

        return $school;
    }

}
