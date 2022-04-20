<?php

namespace App\Repository;

use App\Entity\Post\Post;
use App\Repository\DBConnexion;

class PostRepository extends Repository
{
    protected string $table = 'post';

    public function __construct(DBConnexion $dbConnection)
    {
        parent::__construct($dbConnection, $this->table, Post::class);
    }

    //CREATE NEW POST
    public function createPost(Post $post)
    {
        $insertInto = $this->dbConnection->getPDO()->prepare('INSERT INTO post (userId, title, chapo, content, lastUpdate) VALUES (?,?,?,?,NOW())');
        return $insertInto ->execute(array($post->getUserId(), $post->getTitle(), $post->getChapo(), $post->getContent()));
    }
    //MODIFY ONE POST
    public function modifyPost(Post $post, $id)
    {
        $modifyPost = $this->dbConnection->getPDO()->prepare('UPDATE post SET title = :title, chapo = :chapo, content = :content, lastUpdate = NOW() WHERE id = :id');
        if (
            $modifyPost -> execute([
                'title' => $post->getTitle(),
                'chapo' => $post->getChapo(),
                'content' => $post->getContent(),
                'id' => $id])
        ) {
            return 'Post successfully modified';
        } else {
            return 'An error has occured';
        }
    }
}
