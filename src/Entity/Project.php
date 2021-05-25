<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\ProjectMember;

/**
 * @ORM\Entity()
 * @ORM\Table(name="project")
 */
class Project {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    # link to domain entity (many to many)
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Domain")
     * @ORM\JoinTable(name="jt_project_domain",
     *     joinColumns={@ORM\JoinColumn(name="project_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="domain_id", referencedColumnName="id")}
     * )
     */
    private $domains;

    /**
     * @ORM\Column(type="string")
     */
    private $incubator;

    /**
     * @ORM\Column(type="string")
     */
    private $location;

    # link to the logo location
    /**
     * @ORM\Column(type="string")
     */
    private $logo;

    /**
     * @ORM\Column(type="string")
     */
    private $video;

    # since only one is displayed, need to choose which one it is
    /**
     * @ORM\Column(type="string")
     */
    private $videoOrLogoDisplayed;

    /**
     * @ORM\Column(type="string")
     */
    private $currentPhase;

    # array of phases with True or False if done or not
    # /!\ keep the same order for the phases
    /**
     * @ORM\Column(type="array")
     */
    private $phases;

    /**
     * @ORM\Column(type="string")
     */
    private $globalVision;

    /**
     * @ORM\Column(type="text")
     */
    private $elevatorSpeech;

    # FR : atout du projet
    /**
     * @ORM\Column(type="string")
     */
    private $asset;

    /**
     * @ORM\Column(type="string")
     */
    private $lookingFor;

    /**
     * @ORM\Column(type="string")
     */
    private $mood;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hasImpact;

    # link to projectMember entity (one to many)
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProjectMember", mappedBy="project")
     */
    private $members;

    public function __construc() {
        $this->domains = new ArrayCollection();
        $this->members = new ArrayCollection();
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setDomains(ArrayCollection $domains) {
        $this->domains = $domains;
    }

    public function setIncubator(string $incubator) {
        $this->incubator = $incubator;
    }

    public function setLocation(string $location) {
        $this->location = $location;
    }

    public function setLogo(string $logo) {
        $this->logo = $logo;
    }

    public function setVideo(string $video) {
        $this->video = $video;
    }

    public function setDisplayedContent(string $display) {
        $this->videoOrLogoDisplayed = display;
    }

    public function setCurrentPhase(string $phase) {
        $this->currentPhase = $phase;
    }

    public function setPhases(string $phases) {
        $this->phases = $phases;
    }

    public function setGlobalVision(string $globalVision) {
        $this->globalVision = $globalVision;
    }

    public function setElevatorSpeech(string $speech) {
        $this->elevatorSpeect = $speech;
    }

    public function setAsset(string $asset) {
        $this->asset = $asset;
    }

    public function setLookingFor(string $lookingFor) {
        $this->lookingFor = $lookingFor;
    }

    public function setMood(string $mood) {
        $this->mood = $mood;
    }

    public function setHasImpact(bool $impact) {
        $this->hasImpact = $impact;
    }
    
    public function addMember(ProjectMember $projectMember) {
        $this->members->add($projectMember);
    }

    public function removeMember(ProjectMember $projectMember) {
        $this->members->removeElement($projectMember);
    }
}
