<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


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
     * @ORM\Column(type="string")
     */
    private $studentNumber;

    # location of the pic on the server
    /**
     * @ORM\Column(type="string")
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
     *    inversedJoinColumns={@ORM\JoinColumn(name="job_id", referencedColumnName="id")}
     * )
     */
    private $wantedJobs;

    # link to domain entity (many to many)
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Domain")
     * @ORM\JoinTable(name="jt_student_domain",
     *     joinColumns={@ORM\JoinColumn(name="student_id", referencedColumnName="id")},
     *     inversedJoinColumns={@ORM\JoinColumn(name="domain_id", referencedColumnName="id")}
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
    private $profilePic;

    # where is it ?
    /**
     * @ORM\Column(type="string")
     */

    private $website;
    /**
     * @ORM\Column(type="string")
     */

    private $linkedin;

    /**
     * @ORM\Column(type="string")
     */
    private $instagram;

    /**
     * @ORM\Column(type="string")
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
}
