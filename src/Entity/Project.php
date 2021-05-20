<?php

namespace App\Entity;

class Project {
    private $id;
    private $name;
    # link to domain entity (many to many)
    private $domains;
    private $incubator;    
    private $location;
    private $logo;
    private $video;
    # since only one is displayed, need to choose which one it is
    private $videoOrLogoDisplayed;
    private $target;
    private $currentPhase;
    # JSON of phases with True or False if done or not
    private $phases;
    private $globalVision;
    private $elevatorSpeech;

    # FR : atout du projet
    private $asset;
    private $lookingFor;
    private $mood;
    private $hasImpact;
    # link to projectMember entity (one to many)
    private $members;
}
