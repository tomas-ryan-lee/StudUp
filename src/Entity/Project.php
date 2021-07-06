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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $author;

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
     * @ORM\Column(type="string", nullable=True)
     */
    private $incubator;

    /**
     * @ORM\Column(type="string")
     */
    private $location;

    # link to the logo location
    /**
     * @ORM\Column(type="string", nullable=True)
     */
    private $logo;

    /**
     * @ORM\Column(type="string", nullable=True)
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
     * @ORM\Column(type="array")
     */
    private $asset;

    /**
     * @ORM\Column(type="array")
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

    public function setAuthor(Student $author) {
        $this->author = $author;
    }

    public function setDomains(ArrayCollection $domains) {
        $this->domains = $domains;
    }

    public function setIncubator(?string $incubator) {
        $this->incubator = $incubator;
    }

    public function setLocation(string $location) {
        $this->location = $location;
    }

    public function setLogo(?string $logo) {
        $this->logo = $logo;
    }

    public function setVideo(?string $video) {
        $this->video = $video;
    }

    public function setDisplayedContent(string $display) {
        $this->videoOrLogoDisplayed = $display;
    }

    public function setCurrentPhase(string $phase) {
        $this->currentPhase = $phase;
    }

    public function setPhases(Array $phases) {
        $this->phases = $phases;
    }

    public function setGlobalVision(string $globalVision) {
        $this->globalVision = $globalVision;
    }

    public function setElevatorSpeech(string $speech) {
        $this->elevatorSpeech = $speech;
    }

    public function setAsset(Array $asset) {
        $this->asset = $asset;
    }

    public function setLookingFor(Array $lookingFor) {
        $this->lookingFor = $lookingFor;
    }

    public function setMood(string $mood) {
        $this->mood = $mood;
    }

    public function setHasImpact(bool $impact) {
        $this->hasImpact = $impact;
    }
    
    public function addMember(ProjectMember $projectMember) {
        if($this->members == Null) {
            $this->members = new ArrayCollection();
        }
        $this->members->add($projectMember);
    }

    public function removeMember(ProjectMember $projectMember) {
        $this->members->removeElement($projectMember);
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getDomains() {
        return $this->domains;
    }

    public function getIncubator() {
        return $this->incubator;
    }

    public function getLocation() {
        return $this->location;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function getVideo() {
        return $this->video;
    }

    public function getVideoOrLogoDisplayed() {
        return $this->videoOrLogoDisplayed;
    }

    public function getCurrentPhase() {
        return $this->currentPhase;
    }

    public function getPhases () {
        return $this->phases;
    }

    public function getGlobalVision() {
        return $this->globalVision;
    }

    public function getElevatorSpeech() {
        return $this->elevatorSpeech;
    }

    public function getAsset() {
        return $this->asset;
    }

    public function getLookingFor() {
        return $this->lookingFor;
    }

    public function getMood() {
        return $this->mood;
    }

    public function getHasImpact() {
        return $this->hasImpact;
    }

    public function getMembers() {
        return $this->members;
    }

    public function toArray(array $exclude = []) {
        $data = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'author' => [
                'id' => $this->getAuthor()->getId(),
                'profilePic' => $this->getAuthor()->getProfilePic(),
            ],
            'incubator' => $this->getIncubator(),
            'location' => $this->getLocation(),
            'logo' => $this->getLogo(),
            'video' => $this->getVideo(),
            'videoOrLogo' => $this->getVideoOrLogoDisplayed(),
            'currentPhase' => $this->getCurrentPhase(),
            'phases' => $this->getPhases(),
            'globalVision' => $this->getGlobalVision(),
            'elevatorSpeech' => $this->getElevatorSpeech(),
            'asset' => $this->getAsset(),
            'lookingFor' => $this->getLookingFor(),
            'mood' => $this->getMood(),
            'hasImpact' => $this->getHasImpact(),
        ];
        
        if(!isset($exclude['domains'])) {
            $data['domains'] = [];
            $domains = $this->getDomains();
            foreach($domains as $domain) {
                $data['domains'][] = $domain->toArray();
            }
        }

        if(!in_array('members', $exclude)) {
            $data['members'] = [];
            $members = $this->getMembers();
            foreach($members as $member) {
                $data['members'][] = $member->toArray($exclude = ['project']);
            }
        }

        foreach($exclude as $key) {
            unset($data[$key]);
        }

        return $data;
    }
}
