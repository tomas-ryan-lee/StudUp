<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Job;
use App\Entity\School;
use App\Entity\User;

/**
 * @ORM\Entity()
 * @ORM\Table(name="student")
 */
class Student {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    
    # student or alumni
    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @ORM\Column(type="string")
     */
    private $surname;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $gender;

    /**
     * @ORM\Column(type="date")
     */
    private $birthday;

    # link to school entity (many to one)
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\School")
     * @ORM\JoinColumn(name="school_id", referencedColumnName="id")
     */
    private $school;

    /**
     * @ORM\Column(type="string")
     */
    private $studyLevel;

    /**
     * @ORM\Column(type="integer")
     */
    private $graduationYear;

    /**
     * @ORM\Column(type="string", nullable=True)
     */
    private $studentNumber;

    # location of the pic on the server
    /**
     * @ORM\Column(type="string", nullable=True)
     */
    private $studentCardPic;

    /**
     * @ORM\Column(type="string")
     */
    private $mail;

    # link to user entity (one to one)
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="profile")
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     */
    private $user;

    # link to job entity (many to many)
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Job")
     * @ORM\JoinTable(name="jt_student_wanted_job",
     *    joinColumns={@ORM\JoinColumn(name="student_id", referencedColumnName="id")},
     *    inverseJoinColumns={@ORM\JoinColumn(name="job_id", referencedColumnName="id")}
     * )
     */
    private $wantedJobs;

    # link to domain entity (many to many)
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Domain")
     * @ORM\JoinTable(name="jt_student_domain",
     *     joinColumns={@ORM\JoinColumn(name="student_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="domain_id", referencedColumnName="id")}
     * )
     */
    private $domains;

    /**
     * @ORM\Column(type="string")
     */
    private $newsFrequency;

    # location of the picture on the server
    /**
     * @ORM\Column(type="string")
     */
    private $profilePic = "/public/img/amineTousmi.png";

    # where is it ?
    /**
     * @ORM\Column(type="string", nullable=True)
     */

    private $website;
    /**
     * @ORM\Column(type="string", nullable=True)
     */

    private $linkedin;

    /**
     * @ORM\Column(type="string", nullable=True)
     */
    private $instagram;

    /**
     * @ORM\Column(type="string", nullable=True)
     */
    private $facebook;

    # put false if user last connection > x month
    /**
     * @ORM\Column(type="boolean")
     */
    private $isActif;

    public function __construct() {
        $this->wantedJobs = new ArrayCollection();
        $this->domains = new ArrayCollection();
    }

    public function setStatus(string $status) {
        $this->status = $status;
    }

    public function setSurname(string $surname) {
        $this->surname = $surname;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setGender(string $gender) {
        $this->gender = $gender;
    }

    public function setBirthday(string $birthday) {
        $this->birthday = new DateTime($birthday);
    }

    public function setSchool(School $school) {
        $this->school = $school;
    }

    public function setStudyLevel(string $studyLevel) {
        $this->studyLevel = $studyLevel;
    }

    public function setGraduationYear(int $graduationYear) {
        $this->graduationYear = $graduationYear;
    }

    public function setStudentNumber(?string $studentNumber) {
        $this->studentNumber = $studentNumber;
    }

    public function setStudentCardPic(?string $studentCardPic) {
        $this->studentCardPic = $studentCardPic;
    }

    public function setMail(string $mail) {
        $this->mail = $mail;
    }

    public function setUser(User $user) {
        $this->user = $user;
    } 

    public function setWantedJobs(ArrayCollection $jobs) {
        $this->wantedJobs = $jobs;
    }

    public function setDomains(ArrayCollection $domains) {
        $this->domains = $domains;
    }

    public function setNewsFrequency(string $newsFrequency) {
        $this->newsFrequency = $newsFrequency;
    }

    public function setProfilePic(string $profilePic) {
        $this->profilePic = $profilePic;
    }

    public function setWebsite(?string $website) {
        $this->website = $website;
    }

    public function setLinkedin(?string $linkedin) {
        $this->linkedin = $linkedin;
    }

    public function setInstagram(?string $instagram) {
        $this->instagram = $instagram;
    }

    public function setFacebook(?string $facebook) {
        $this->facebook = $facebook;
    }

    public function setIsActif(bool $isActif) {
        $this->isActif = $isActif;
    }

    public function getId() {
        return $this->id;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getName() {
        return $this->name;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getBirthday() {
        return $this->birthday;
    }

    public function getSchool() {
        return $this->school;
    }

    public function getStudyLevel() {
        return $this->studyLevel;
    }

    public function getGraduationYear() {
        return $this->graduationYear;
    }

    public function getStudentNumber() {
        return $this->studentNumber;
    }

    public function getStudentCardPic() {
        return $this->studentCardPic;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getUser() {
        return $this->user;
    } 

    public function getWantedJobs() {
        return $this->wantedJobs;
    }

    public function getDomains() {
        return $this->domains;
    }

    public function getNewsFrequency() {
        return $this->newsFrequency;
    }

    public function getProfilePic() {
        return $this->profilePic;
    }

    public function getWebsite() {
        return $this->website;
    }

    public function getLinkedin() {
        return $this->linkedin;
    }

    public function getInstagram() {
        return $this->instagram;
    }

    public function getFacebook() {
        return $this->facebook;
    }

    public function getIsActif() {
        return $this->isActif;
    }

    public function toArray(array $exclude = []) {
        $data = [
            'id' => $this->getId(),
            'status' => $this->getStatus(),
            'surname' => $this->getSurname(),
            'name' => $this->getName(),
            'gender' => $this->getGender(),
            'birthday' => $this->getBirthday(),
            'school' => $this->getSchool()->toArray(),
            'studyLevel' => $this->getStudyLevel(),
            'graduationYear' => $this->getGraduationYear(),
            'studentNumber' => $this->getStudentNumber(),
            'studentCardPic' => $this->getStudentCardPic(),
            'mail' => $this->getMail(),
            // needs to avoid recursiv call
            'user' => !in_array('user', $exclude) ? $this->getUser()->toArray($exclude = ['profile']) : Null,
            'newsFrequency' => $this->getNewsFrequency(),
            'profilePic' => $this->getProfilePic(),
            'website' => $this->getWebsite(),
            'linkedin' => $this->getLinkedin(),
            'instagram' => $this->getInstagram(),
            'facebook' => $this->getFacebook(),
            'isActif' => $this->getIsActif()
        ];

        $wantedJobs = $this->getWantedJobs();
        $wjArray = [];
        foreach($wantedJobs as $job) {
            $jwArray[] = $job->toArray();
        }
        $data['wantedJobs'] = $wjArray;

        $domains = $this->getDomains();
        $domArray = [];
        foreach($domains as $domain) {
            $domArray[] = $domain->toArray();
        }
        $data['domains'] = $domArray;

        foreach($exclude as $key) {
            unset($data[$key]);
        }
        return $data;
    }

}
