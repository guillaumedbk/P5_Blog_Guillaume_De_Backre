<?php

namespace App\Repository;

use App\Entity\User\User;

class UserRepository extends Repository
{
    public function __construct(\App\Repository\DBConnexion $dbConnection)
    {
        parent::__construct($dbConnection, 'user', User::class);
    }

    //INSERT NEW ELEMENT
    public function createUser($firstname, $name, $email, $status, $bio, $password)
    {
         $insertInto = $this->dbConnection->getPDO()->prepare('INSERT INTO user (firstname, name, email, status, bio, password) VALUES (?,?,?,?,?,?)');
         return $insertInto ->execute(array($firstname, $name, $email, $status, $bio, $password));
    }



}