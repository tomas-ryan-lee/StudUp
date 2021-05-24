<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 * @ORM\Table(name="project")
 */
class Project {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="string")
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
}
