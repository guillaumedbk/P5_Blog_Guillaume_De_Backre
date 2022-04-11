<?php

namespace App\Repository;

use App\Entity\User\User;

class UserRepository
{
    private DBConnexion $dbConnection;

    public function __construct(DBConnexion $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        $result = $this->dbConnection->execute('SELECT*FROM user');
        $users = [];
        foreach ($result as $item){
            $users[] = new User($item['firstname'], $item['name'],$item['email'], $item['status'], $item['bio'],$item['password']);
        }
        return $users;
    }

}