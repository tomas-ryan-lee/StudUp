<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Doctrine\Common\Proxy\Exception\UnexpectedValueException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Project;
use App\Entity\Student;

class ProjectRepository extends ServiceEntityRepository {

    private $manager;
    private $fieldList = [
        'id',
        'name',
        'domains',
        'incubator',
        'location',
        'logo',
        'video',
        'videoOrLogoDisplayed',
        'currentPhase',
        'phases',
        'globalVision', 
        'elevatorSpeech',
        'asset',
        'lookingFor',
        'mood',
        'hasImpact',
        'job',
        'jobCategory',
    ];

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    ) {
        parent::__construct($registry, Project::class);
        $this->manager = $manager;
    }

    public function saveProject(
        string $name,
        Student $author,
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
        $project->setAuhtor($author);
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

    public function removeProject(Project $project) {
        $this->manager->remove($project);
        $this->manager->flush();
    }

    public function updateStudent(Project $project) {
        $this->manager->persist($project);
        $this->manager->flush();

        return $student;
    }
    
    
    public function findOrFilteredProjects($filters) {
        $query = $this->createQueryBuilder('p');
        foreach($filters as $key => $value) {
            if (!in_array($key, $this->fieldList)) {
                throw new UnexpectedValueException();
            }
            if (!is_array($value)) {
                $value = [$value];
            }
            if(!($value == [])) {
                $sqlArray = '("'.join('", "', $value).'")';
                $query->orWhere('p.'.$key.' IN '.$sqlArray.' ');
            }
        }
        print_r($query->getQuery()->getSql());
        return $query->getQuery()->execute();
    }
    
    // for later use
    public function findAndFilteredProjects($filters) {
        $query = $this->createQueryBuilder('p');
        foreach($filters as $key => $value) {
            if (!in_array($key, $this->fieldList)) {
                throw new UnexpectedValueException();
            }
            if (!is_array($value)) {
                $value = [$value];
            }
            
            $query->AndWhere('p.? IN :array', $key)
                ->setParameter('array', $value);
        }
        return $query->getQuery()->execute();
    }

    // public function findByDomains($domains) {
    //     $query = $this->getEntityManager()
    //         ->createQuery(
    //             'SELECT p, d FROM App\Entity\Project p
    //             INNER JOIN p.domains d
    //             WHERE d.name = :names'
    //         )->setParameters('names', "Audiovisuel");
    //     return $query->getResult();
    // }

}
