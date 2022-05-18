<?php

namespace App\Entity\User;

class UserSignUpDTO
{
    //Attributes
    public $firstname;
    public $name;
    public $email;
    public $status = 'admin';
    public $bio;
    public $password;
}
