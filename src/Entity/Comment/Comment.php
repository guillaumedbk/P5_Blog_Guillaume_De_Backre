<?php

namespace App\Entity\Comment;

use App\Entity\EntityInterface;

class Comment implements EntityInterface
{
    //Attributes
    private ?int $id = null;
    private int $userId;
    private int $postId;
    private string $content;
    private \DateTime $publishAt;
    private string $status;

    //Constructor
    public function __construct(int $userId, int $postId, string $content, \DateTime $publishAt, string $status)
    {
        $this->userId = $userId;
        $this->postId = $postId;
        $this->content = $content;
        $this->publishAt = $publishAt;
        $this->status = $status;
    }

    //Retrieves the array with the data from the db and returns an object
    public static function createFromDb(array $element): self
    {
        $publishAt = new \DateTime($element['publishAt']);
        $comment = new Comment($element['userId'], $element['postId'], $element['content'], $publishAt, $element['status']);
        $comment->id = $element['id'];
        return $comment;
    }

    //Getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }
    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    public function getContent(): string
    {
        return $this->content;
    }
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getPublishAt(): \DateTime
    {
        return $this->publishAt;
    }
    public function setPublishAt(\DateTime $publishAt): void
    {
        $this->publishAt = $publishAt;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
