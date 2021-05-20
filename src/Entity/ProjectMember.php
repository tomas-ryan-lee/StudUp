<?php

namespace App\Entity;

class ProjectMember {
    private $id;
    # link to project entity (many to one)
    private $project;
    # link to student entity (many to one)
    private $student;
    # link to job entity (many to one)
    private $job;
    # FR : consultant, prestataire, associé
    private $type;
    private $detail;
    private $retribution;

    # True if there is no student
    private $isFree;
    # need to be empty if student is filled
    # link to student entity (many to many)
    private $applicant;
}
