<?php

namespace App\Repository;

use App\Entity\User\User;

class UserRepository extends Repository
{
    protected $table = 'user';

    public function __construct(\App\Repository\DBConnexion $dbConnection)
    {
        parent::__construct($dbConnection, $this->table, User::class);
    }

    //CREATE NEW USER BY PASSING AN OBJECT
    public function createUser(User $user)
    {
        $insertInto = $this->dbConnection->getPDO()->prepare('INSERT INTO user (firstname, name, email, status, bio, password) VALUES (?,?,?,?,?,?)');
        return $insertInto ->execute(array($user->getFirstname(), $user->getName(), $user->getEmail(), $user->getStatus(), $user->getBio(),$user->getPassword()));
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
                'id' => $id
                ])) {
                return 'User successfully modified';
            }else{
                return 'An error has occured';
            }
    }
    //MODIFY USER STATUS
    public function modifyUserStatus($userId, $newStatus){
        $req = $this->dbConnection->getPDO()->prepare('UPDATE user SET status = :status WHERE id = :id');
            if ($req-> execute(['status' => $newStatus, 'id' => $userId])){
                return 'User status successfully modified';
            }else{
                return 'An error has occured';
            }
    }
}