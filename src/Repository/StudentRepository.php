<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\School;
use App\Entity\Student;
use App\Entity\User;

class StudentRepository extends ServiceEntityRepository {

    private $manager;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    ) {
        parent::__construct($registry, Student::class);
        $this->manager = $manager;
    }

    public function saveStudent(
        string $status,
        string $surname,
        string $name,
        string $gender,
        string $birthday,
        School $school,
        string $studyLevel,
        int $graduationYear,
        ?string $studentNumber,
        ?string $studentCardPic,
        string $mail,
        ?User $user,
        ArrayCollection $jobs,
        ArrayCollection $domains,
        ArrayCollection $favorites,
        string $newsFrequency,
        string $profilePic,
        ?string $website,
        ?string $linkedin,
        ?string $instagram,
        ?string $facebook,
        bool $isActif
    ) {
        $student = new Student();

        $student->setStatus($status);
        $student->setSurname($surname);
        $student->setName($name);
        $student->setGender($gender);
        $student->setBirthday($birthday);
        $student->setSchool($school);
        $student->setStudyLevel($studyLevel);
        $student->setGraduationYear($graduationYear);
        $student->setStudentNumber($studentNumber);
        $student->setStudentCardPic($studentCardPic);
        $student->setMail($mail);
        $student->setUser($user);
        $student->setWantedJobs($jobs);
        $student->setDomains($domains);
        $student->setNewsFrequency($newsFrequency);
        $student->setProfilePic($profilePic);
        $student->setWebsite($website);
        $student->setLinkedin($linkedin);
        $student->setInstagram($instagram);
        $student->setFacebook($facebook);
        $student->setIsActif($isActif);

        foreach($favorites as $fav) {
            $student->addFavorite($fav);
        }

        $this->manager->persist($student);
        $this->manager->flush();
    }

    public function removeStudent(Student $student) {
        $this->manager->remove($student);
        $this->manager->flush();
    }

    public function updateStudent(Student $student) {
        $this->manager->persist($student);
        $this->manager->flush();

        return $student;
    }
}
