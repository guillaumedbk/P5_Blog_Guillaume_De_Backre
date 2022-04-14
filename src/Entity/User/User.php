<?php
namespace App\Entity\User;

class User
{
    //Attributes
    private $firstname;
    private $name;
    private $email;
    private $status;
    private $bio;
    private $password;

    //Constructor
    public function __construct($firstname=NULL, $name=NULL, $email=NULL, $status=NULL, $bio=NULL, $password=NULL){
        $this->firstname = $firstname  === NULL ? $this->firstname : $firstname;
        $this->name = $name === NULL ? $this->name: $name;
        $this->email = $email === NULL ? $this->email : $email;
        $this->status = $status === NULL ? $this->status : $status;
        $this->bio = $bio === NULL ? $this->bio : $bio;
        $this->password = $password === NULL ? $this->password : $password;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
}