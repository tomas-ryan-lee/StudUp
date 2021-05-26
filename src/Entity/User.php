<?php

namespace App\Entity;

use Datetime;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Student;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
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
     * @ORM\OneToOne(targetEntity="App\Entity\Student", mappedBy="user", cascade={"persist"})
     */
    private $profil;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastConnection;

    // ID of the confirmation link used for mail confirmation or reset password
    /**
     * @ORM\Column(type="string", nullable=True)
     */
    private $confirmationUUID;


    public function __construct() {

        $this->lastConnection = new DateTime();
    }

    public function setLogin(string $login) {
        $this->login = $login;
    }
    
    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function setProfile(Student $student) {
        $this->profile = $student;
    }

    public function updateLastConnection() {
<<<<<<< HEAD
        $this->lastConnection = new DateTime();
=======
        $this->lastConnection = new DateTime());
>>>>>>> e71cc04... Change date type in user to match ORM type
    }

    public function setConfirmationUUID(?string $confirmationUUID) {
        $this->confirmationUUID = $confirmationUUID;
    }

    public function deleteConfirmatinUUID() {
        $this->confirmationUUID = NULL;
    }
}
