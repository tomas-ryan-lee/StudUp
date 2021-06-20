<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Job;
use App\Entity\Project;
use App\Entity\ProjectMember;


class ProjectMemberRepository extends ServiceEntityRepository {

    private $manager;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    ) {
        parent::__construct($registry, ProjectMember::class);
        $this->manager = $manager;
    }

    public function saveProjectMember(
        Job $job,
        Project $project,
        string $type, 
        string $detail,
        string $retribution,
        bool $isFree

        // fields : student, job, type, detail, retribution, isFree, applicants, project
    ) {
        $projectMember = new Projectmember();
        // treat fields
        $projectMember->setJob($job);
        $projectMember->setProject($project);
        $projectMember->setType($type);
        $projectMember->setDetail($detail);
        $projectMember->setRetribution($retribution);
        $projectMember->setIsFree($$isFree);

        $projectMember->getProject()->addMember($projectMember);

        $this->manager->persist($projectMember);
        $this->manager->flush();
    }

    public function removeProjectMember(ProjectMember $projectMember) {
        $projectMember->project->removeMember($projectMember);
        $this->manager->remove($projectMember);
        $this->manager->flush();
    }

    public function updateProjectMember(ProjectMember $projectMember) {
        $this->manager->persist($projectMember);
        $this->managert->flush();

        return $projectMember;
    }
}
