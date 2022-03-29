<?php
namespace App\Entity\Post;

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
    public function __construct($firstname, $name, $email, $status, $bio, $password){
        $this->firstname = $firstname;
        $this->name = $name;
        $this->email = $email;
        $this->status = $status;
        $this->bio = $bio;
        $this->password = $password;
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