<?php

namespace App\Repository;

use App\Entity\Comment\Comment;

class CommentRepository extends Repository
{
    protected $table = 'comments';

    public function __construct(\App\Repository\DBConnexion $dbConnection)
    {
        parent::__construct($dbConnection, $this->table, Comment::class);
    }

    //CREATE COMMENT
    public function createComment(Comment $comment)
    {
        $insertInto = $this->dbConnection->getPDO()->prepare('INSERT INTO comments(userId, postId, content, publishAt, status) VALUES(?, ?, ?, NOW(), "attente")');
        return $insertInto->execute(array($comment->getUserId(), $comment->getPostId(), $comment->getContent()));
    }


}