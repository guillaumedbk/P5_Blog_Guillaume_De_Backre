<?php

namespace App\Repository;

use App\Entity\Post\Post;
use App\Entity\Post\PostDTO;
use App\Repository\DBConnexion;

class PostRepository extends Repository
{
    //ATTRIBUTE
    protected string $table = 'post';

    //CONSTRUCTOR
    public function __construct(DBConnexion $dbConnection)
    {
        parent::__construct($dbConnection, $this->table, Post::class);
    }

    //CREATE NEW POST
    public function createPost(Post $post): bool
    {
        try {
            $insertInto = $this->dbConnection->getPDO()->prepare('INSERT INTO post (userId, title, chapo, content, lastUpdate) VALUES (?,?,?,?,NOW())');
            return $insertInto ->execute([$post->getUserId(), $post->getTitle(), $post->getChapo(), $post->getContent()]);
        } catch (\PDOException $exception) {
            $logger = new FileLogger('logger.log');
            $logger->critical("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
            throw new \PDOException("The following error has occured:  {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }
    //MODIFY ONE POST
    public function modifyPost(Post $post, $id): bool
    {
        $modifyPost = $this->dbConnection->getPDO()->prepare('UPDATE post SET title = :title, chapo = :chapo, content = :content, lastUpdate = NOW() WHERE id = :id');
        try {
            return $modifyPost -> execute([
                'title' => $post->getTitle(),
                'chapo' => $post->getChapo(),
                'content' => $post->getContent(),
                'id' => $id]);
        } catch (\PDOException $exception) {
            $logger = new FileLogger('logger.log');
            $logger->critical("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
            throw new \PDOException("The following error has occured:  {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }
}
