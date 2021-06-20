<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Project;

class ProjectRepository extends ServiceEntityRepository {

    private $manager;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    ) {
        parent::__construct($registry, Project::class);
        $this->manager = $manager;
    }

    public function saveProject(
        string $name,
        string $incubator,
        string $location,
        ?string $logo,
        ?string $video,
        ?string $videoOrLogo, 
        string $currentPhase,
        array $phases,
        string $globalVision,
        string $elevatorSpeech,
        array $asset,
        array $lookingFor,
        string $mood,
        bool $hasImpact,
        ArrayCollection $domains,
        ArrayCollection $members
    ) {
        $project = new Project();

        $project->setName($name);
        $project->setIncubator($incubator);
        $project->setLocation($location);
        $project->setLogo($logo);
        $project->setVideo($video);
        $project->setVideoOrLogoDisplayed($videoOrLogo);
        $project->setCurrentPhase($currentPhase);
        $project->setPhases($phases);
        $project->setGlobalVision($globalVision);
        $project->setElevatorSpeech($elevatorSpeech);
        $project->setAsset($asset);
        $project->setLookingFor($lookingFor);
        $project->setMood($mood);
        $project->hasImpact($hasImpact);
        $project->setDomains($domains);
        
        foreach($members as $member) {
            $project->addMember($member);
        }

        $this->manager->persist($project);
        $this->manager->flush();
    }

    public function removeProject(Student $student) {
        $this->manager->remove($student);
        $this->manager->flush();
    }

    public function updateStudent(Student $student) {
        $this->manager->persist($student);
        $this->manager->flush();

        return $student;
    }

}
