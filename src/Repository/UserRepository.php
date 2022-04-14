<?php

namespace App\Repository;

use App\Entity\User\User;

class UserRepository extends Repository
{
    public function __construct(\App\Repository\DBConnexion $dbConnection)
    {
        parent::__construct($dbConnection, 'user', User::class);
    }

    //CREATE NEW USER
    public function createUser($firstname, $name, $email, $status, $bio, $password)
    {
         $insertInto = $this->dbConnection->getPDO()->prepare('INSERT INTO user (firstname, name, email, status, bio, password) VALUES (?,?,?,?,?,?)');
         return $insertInto ->execute(array($firstname, $name, $email, $status, $bio, $password));
    }
    //MODIFY ONE USER
    public function modifyUser($id, $firstname, $name, $email, $bio, $password)
    {
        $modifyUser = $this->dbConnection->getPDO()->prepare('UPDATE user SET firstname = :firstname, name = :name, email = :email, bio = :bio, password = :password WHERE id = :id');
            if (
                $modifyUser->execute([
                'firstname' => $firstname,
                'name' => $name,
                'email' => $email,
                'bio' => $bio,
                'password' => $password,
                'id' => $id])
            ){
                return 'User successfully modified';
            }else{
                return 'An error has occured';
            }
    }
}