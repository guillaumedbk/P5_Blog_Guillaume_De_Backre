<?php

namespace App\Repository;

use App\Entity\Post\Post;

class PostRepository extends Repository
{
    protected $table = 'post';

    public function __construct(\App\Repository\DBConnexion $dbConnection)
    {
        parent::__construct($dbConnection, $this->table, Post::class);
    }
}