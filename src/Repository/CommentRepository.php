<?php

namespace App\Repository;

use App\Entity\Comment\Comment;
use App\Entity\Comment\CommentDTO;
use App\Repository\DBConnexion;
use PDO;

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
            $insertInto = $this->dbConnection->getPDO()->prepare('INSERT INTO comments(userId, postId, content, publishAt, status) VALUES(?, ?, ?, ?, ?)');
            return $insertInto->execute([$comment->getUserId(), $comment->getPostId(), $comment->getContent(), $comment->getPublishAt()->format('Y-m-d H:i:s'), $comment->getStatus()]);
        } catch (\PDOException $exception) {
            $logger = new FileLogger('logger.log');
            $logger->critical("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
            throw new \PDOException("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }

    //GET COMMENTS FROM ONE POST
    public function getOnePostComments($id): array
    {
        $req = $this->dbConnection->getPDO()->prepare("SELECT * FROM {$this->table} WHERE postId = ?");
        $req->execute(array($id));

        $fetchAll = $req->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($fetchAll as $item) {
            $result[] = $this->hydrate($item);
        }
        return $result;
    }

    //CHANGE COMMENT STATUS
    public function changeStatus($id): bool
    {
        $req = $this->dbConnection->getPDO()->prepare('UPDATE comments SET status = "accepted" WHERE id = ?');
        return $req -> execute(array($id));
    }
}
