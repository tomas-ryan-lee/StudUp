<?php

namespace App\Entity;

class User {
    private $id;
    # login = mail
    private $login;
    private $password;
    # link to student entity (one to one)
    private $profil;
    private $lastConnection;

    // ID of the confirmation link used for mail confirmation or reset password
    private $confirmationUUID;
}
