<?php

namespace App\Entity;

class User {
    private $id;
    private $login;
    private $password;
    private $profil;
    private $lastConnection;

    // ID of the confirmation link used for mail confirmation or reset password
    private $confirmationUUID;
}
