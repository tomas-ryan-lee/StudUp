<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 * @ORM\Table(name="project_member")
 */
class ProjectMember {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="string")
     */
    private $id;

    # link to project entity (many to one)
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="members")
     * @JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;

    # link to student entity (many to one)
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $student;

    # link to job entity (many to one)
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Job")
     * @ORM\JoinColumn(name="job_id", referencedColumnName="id")
     */
    private $job;

    # FR : consultant, prestataire, associé
    /**
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @ORM\Column(type="text")
     */
    private $detail;

    /**
     * @ORM\Column(type="string")
     */
    private $retribution;

    # True if there is no student
    /**
     * @ORM\Column(type="boolean")
     */
    private $isFree;

    # need to be empty if student is filled
    # link to student entity (many to many)
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Student")
     * @ORM\JoinTable(name="jt_project_applicant",
     *    joinColumns={@ORM\JoinColumn(name="project_members_id", referencedColumnName="id")},
     *    inverseJoinColumn={@ORM\JoinColumn(name="applicant_id", referencedColumnName="id")}
     * )
     */
    private $applicants;


    public function __construct() {
        $this->applicants = new ArrayCollections();
    }
}
