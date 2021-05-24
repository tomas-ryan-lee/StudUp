<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="string")
     */
    private $id;

    # login = mail
    /**
     * @ORM\Column(type="string")
     */
    private $login;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    # link to student entity (one to one)
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Student", mappedBy="user")
     */
    private $profil;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastConnection;

    // ID of the confirmation link used for mail confirmation or reset password
    /**
     * @ORM\Column(type="string")
     */
    private $confirmationUUID;
}
