<?php

namespace App\Repository;

use App\Entity\Comment\Comment;
use App\Repository\DBConnexion;

class CommentRepository extends Repository
{
    //ATTRIBUTES
    protected string $table = 'comments';

    //CONSTRUCTOR
    public function __construct(DBConnexion $dbConnection)
    {
        parent::__construct($dbConnection, $this->table, Comment::class);
    }

    //CREATE COMMENT
    public function createComment(Comment $comment): bool
    {
        try {
            $insertInto = $this->dbConnection->getPDO()->prepare('INSERT INTO comments(userId, postId, content, publishAt, status) VALUES(?, ?, ?, NOW(), "attente")');
            return $insertInto->execute([$comment->getUserId(), $comment->getPostId(), $comment->getContent()]);
        } catch (\PDOException $exception) {
            $logger = new FileLogger('logger.log');
            $logger->critical("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
            throw new \PDOException("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }
}
