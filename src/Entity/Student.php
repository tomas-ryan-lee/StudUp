<?php

namespace App\Entity;

class Student {
    private $id;
    # student or alumni
    private $status;
    private $surname;
    private $name;
    private $gender;
    private $birthday;
    private $school;
    private $studyLevel;
    private $graduationYear;
    private $studentNumber;
    private $studentCardPic;
    private $mail;
    # link to user entity (one to one)
    private $user;
    # link to job entity (many to many)
    private $wantedJobs;
    # link to domain entity (many to many)
    private $domains;
    private $newsFrequency;
    private $profilePic;

    # where is it ?
    private $website;
    private $linkedin;
    private $instagram;
    private $facebook;

    # put false if user last connection > x month
    private $isActif;
}
