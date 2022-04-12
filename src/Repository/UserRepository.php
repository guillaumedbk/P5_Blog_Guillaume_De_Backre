<?php

namespace App\Repository;

use App\Entity\User\User;

class UserRepository extends Repository
{
    public function __construct(\App\Repository\DBConnexion $dbConnection)
    {
        parent::__construct($dbConnection, 'user');
    }

}