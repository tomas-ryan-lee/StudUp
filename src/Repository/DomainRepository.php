<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Domain;

class DomainRepository extends ServiceEntityRepository {

    private $manager;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    ) {
        parent::__construct($registry, Domain::class);
        $this->manager = $manager;
    }

    public function saveDomain(string $name, ?string $category) {
        $domain = new Domain();
        $domain->setName($name);
        $domain->setCategory($category);

        $this->manager->persist($domain);
        $this->manager->flush();
        return $domain;
    }

    public function removeDomain(Domain $domain) {
        $this->manager->remove($domain);
        $this->manager->flush();
    }

    public function updateDomain(Domain $domain) {
        $this->manager->persist($domain);
        $this->manager->flush();

        return $domain;
    }
}
