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
    private $profile;

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

    public function setProfile(?Student $student) {
        $this->profile = $student;
    }

    public function updateLastConnection() {
        $this->lastConnection = new DateTime();
    }

    public function setConfirmationUUID(?string $confirmationUUID) {
        $this->confirmationUUID = $confirmationUUID;
    }

    public function deleteConfirmatinUUID() {
        $this->confirmationUUID = NULL;
    }

    public function getId() {
        return $this->id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getProfile() {
        return $this->profile;
    }

    public function getLastConnection() {
        return $this->lastConnection;
    }

    public function getConfirmationUUID() {
        return $this->confimationUUID;
    }

    public function toArray(array $exclude = []) {
        $data = [
            'id' => $this->getId(),
            'login' => $this->getLogin(),
            // needs to avoid recursiv call
            'profile' => !in_array('profile', $exclude) ? $this->getProfile()->toArray($exclude = ['user']) : Null,
            'lastConnection' => $this->getLastConnection(),
        ];
        foreach($exclude as $key) {
            unset($data[$key]);
        }
        return $data;
    }
}
