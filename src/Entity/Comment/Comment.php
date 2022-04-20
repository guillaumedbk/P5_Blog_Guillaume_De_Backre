<?php

namespace App\Entity\Comment;

use App\Entity\EntityInterface;

class Comment implements EntityInterface
{
    //Attributes
    private ?int $id = NULL;
    private int $userId;
    private int $postId;
    private string $content;
    private \DateTime $publishAt;
    private string $status;

    public function __construct(int $userId, int $postId, string $content, \DateTime $publishAt, string $status)
    {
        $this->userId = $userId;
        $this->postId = $postId;
        $this->content = $content;
        $this->publishAt = $publishAt;
        $this->status = $status;
    }

    public static function createFromDb(array $element):self
    {
        $publishAt = new \DateTime($element['publishAt']);
        $comment = new Comment($element['userId'], $element['postId'], $element['content'], $publishAt, $element['status']);
        $comment->id = $element['id'];
        return $comment;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     */
    public function setPostId(int $postId): void
    {
        $this->postId = $postId;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return \DateTime
     */
    public function getPublishAt(): \DateTime
    {
        return $this->publishAt;
    }

    /**
     * @param \DateTime $publishAt
     */
    public function setPublishAt(\DateTime $publishAt): void
    {
        $this->publishAt = $publishAt;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }


}