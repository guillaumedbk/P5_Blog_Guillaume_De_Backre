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

    //CREATE NEW POST
    public function createPost(Post $post)
    {
        $insertInto = $this->dbConnection->getPDO()->prepare('INSERT INTO post (userId, title, chapo, content, lastUpdate) VALUES (?,?,?,?,NOW())');
        return $insertInto ->execute(array($post->getUserId(), $post->getTitle(), $post->getChapo(), $post->getContent()));
    }
}