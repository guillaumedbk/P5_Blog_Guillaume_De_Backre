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
    public function __construct(?int $id = null, string $firstname, string $name, string $email, string $status, string $bio, string $password)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->name = $name;
        $this->email = $email;
        $this->status = $status;
        $this->bio = $bio;
        $this->password = $password;
    }

    //Retrieves the array with the data from the db and returns an object
    public static function createFromDb(array $element): self
    {
        $user = new User($element['id'], $element['firstname'], $element['name'], $element['email'], $element['status'], $element['bio'], $element['password']);
        return $user;
    }

    //Getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getBio(): string
    {
        return $this->bio;
    }
    public function setBio(string $bio): void
    {
        $this->bio = $bio;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
