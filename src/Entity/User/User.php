<?php

namespace App\Entity\User;

use App\Entity\EntityInterface;

class User implements EntityInterface
{
    //Attributes
    private ?int $id = null;
    private string $firstname;
    private string $name;
    private string $email;
    private string $status;
    private string $bio;
    private string $password;

    //Constructor
    public function __construct(string $firstname, string $name, string $email, string $status, string $bio, string $password)
    {
        $this->firstname = $firstname;
        $this->name = $name;
        $this->email = $email;
        $this->status = $status;
        $this->bio = $bio;
        $this->password = $password;
    }

    public static function createFromDb(array $element): self
    {
        $user = new User($element['firstname'], $element['name'], $element['email'], $element['status'], $element['bio'], $element['password']);
        $user->id = $element['id'];
        return $user;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getBio(): string
    {
        return $this->bio;
    }

    /**
     * @param string $bio
     */
    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
