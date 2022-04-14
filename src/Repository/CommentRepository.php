<?php

namespace App\Repository;

class CommentRepository extends Repository
{
    protected $table = 'comments';

    public function __construct(\App\Repository\DBConnexion $dbConnection, $table, $entity)
    {
        parent::__construct($dbConnection, $table, $entity);
    }

}