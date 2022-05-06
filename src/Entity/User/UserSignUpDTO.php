<?php

namespace App\Entity\User;

class UserSignUpDTO
{
    //Attributes
    public string $firstname;
    public string $name;
    public string $email;
    public string $status = 'admin';
    public string $bio;
    public string $password;
}
