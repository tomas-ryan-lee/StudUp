<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Job;


class JobRepository extends ServiceEntityRepository {

    private $manager;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    ) {
        parent::__construct($registry, Job::class);
        $this->manager = $manager;
    }

    public function saveJob(string $name, ?string $category) {
        $job = new Job();
        $job->setName($name);
        $job->setCategory($category);

        $this->manager->persist($job);
        $this->manager->flush();
        return $job;
    }

    public function removeJob(Job $job) {
        $this->manager->remove($job);
        $this->manager->flush();
    }

    public function updateJob(Job $job) {
        $this->manager->persist($job);
        $this->manager->flush();

        return $job;
    }
}
