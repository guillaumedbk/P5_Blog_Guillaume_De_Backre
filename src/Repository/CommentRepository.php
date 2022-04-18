<?php

namespace App\Repository;

use App\Entity\Comment\Comment;
use App\Repository\DBConnexion;

class CommentRepository extends Repository
{
    protected string $table = 'comments';

    public function __construct(DBConnexion $dbConnection)
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