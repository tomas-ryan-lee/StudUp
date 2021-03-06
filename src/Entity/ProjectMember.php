<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Job;
use App\Entity\Project;
use App\Entity\Student;


/**
 * @ORM\Entity()
 * @ORM\Table(name="project_member")
 */
class ProjectMember {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    # link to project entity (many to one)
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="members")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
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
     * @ORM\Column(type="string", nullable=True)
     */
    private $retribution;

    # True if there is no student
    /**
     * @ORM\Column(type="boolean")
     */
    private $isFree;

    # needs to be empty if student is filled
    # link to student entity (many to many)
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Student")
     * @ORM\JoinTable(name="jt_project_applicant",
     *    joinColumns={@ORM\JoinColumn(name="project_members_id", referencedColumnName="id")},
     *    inverseJoinColumns={@ORM\JoinColumn(name="applicant_id", referencedColumnName="id")}
     * )
     */
    private $applicants;


    public function __construct() {
        $this->applicants = new ArrayCollection();
    }

    public function setProject(Project $project) {
        $this->project = $project;
    }

    public function setStudent(?Student $student) {
        $this->student = $student;
    }

    public function setJob(Job $job) {
        $this->job = $job;
    }

    public function setType(string $type) {
        $this->type = $type;
    }

    public function setDetail(string $detail) {
        $this->detail = $detail;
    }

    public function setRetribution(?string $retribution) {
        $this->retribution = $retribution;
    }

    public function setIsFree(bool $isFree) {
        $this->isFree = $isFree;
    }

    public function addApplicant(Student $student) {
        if($this->applicants == Null) {
            $this->applicants = new ArrayCollection();
        }
        $this->applicants->add($student);
    }

    public function removeApplicant(Student $student) {
        $this->applicants->removeElement($student);
    }

    public function clearApplicant() {
        $this->applicants->clear();
    }

    public function getId() {
        return $this->id;
    }

    public function getProject() {
        return $this->project;
    }

    public function getStudent() {
        return $this->student;
    }

    public function getJob() {
        return $this->job;
    }

    public function getType() {
        return $this->type;
    }

    public function getDetail() {
        return $this->detail;
    }

    public function getRetribution() {
        return $this->retribution;
    }

    public function getIsFree() {
        return $this->isFree;
    }

    public function getApplicants() {
        return $this->applicants;
    }

    public function toArray($exclude = []) {
        $data = [
            'id' => $this->getId(),
            'job' => $this->getJob()->toArray(),
            'type' => $this->getType(),
            'detail' => $this->getDetail(),
            'retribution' => $this->getRetribution(),
            'isFree' => $this->getIsFree()
        ];

        if($this->getStudent() != null) {
            $data['student'] = $this->getStudent()->toArray();
        } else {
            $data['student'] = null; 
        }

        $applicantsArray = [];
        $applicants = $this->getApplicants();
        foreach($applicants as $applicant) {
            $applicantsArray[] = $applicant->toArray();
        }
        $data['applicants'] = $applicantsArray;

        $data['project'] = !in_array('project', $exclude) ? $this->project->toArray($exclude=['members']) : Null;

        foreach($exclude as $key) {
            unset($data[$key]);
        }

        return $data;
    }
}
