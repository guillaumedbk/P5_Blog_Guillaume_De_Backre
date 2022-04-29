<?php

namespace App\Entity\User;

class UserConnectInfo
{
    //Attributes
    private string $email;
    private string $password;
    private string $token;

    //Constructor
    public function __construct(string $email, string $password, string $token)
    {
        $this->email = $email;
        $this->password = $password;
        $this->token = $token;
    }

    //Getters and setters
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

}