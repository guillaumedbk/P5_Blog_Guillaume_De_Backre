<?php
namespace App\Entity\User;

class User
{
    //Attributes
    private string $firstname;
    private string $name;
    private string $email;
    private string $status;
    private string $bio;
    private string $password;

    /**
     * @param string|NULL $firstname
     * @param string|NULL $name
     * @param string|NULL $email
     * @param string|NULL $status
     * @param string|NULL $bio
     * @param string|NULL $password
     */
    //Constructor
    public function __construct(string $firstname=NULL, string $name=NULL, string $email=NULL, string $status=NULL, string $bio=NULL, string $password=NULL){
        $this->firstname = $firstname  === NULL ? $this->firstname : $firstname;
        $this->name = $name === NULL ? $this->name: $name;
        $this->email = $email === NULL ? $this->email : $email;
        $this->status = $status === NULL ? $this->status : $status;
        $this->bio = $bio === NULL ? $this->bio : $bio;
        $this->password = $password === NULL ? $this->password : $password;
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