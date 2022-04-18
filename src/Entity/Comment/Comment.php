<?php

namespace App\Entity\Comment;

class Comment
{
    //Attributes
    protected int $userId;
    protected int $postId;
    protected string $content;
    //TODO Is string type ok for date ?
    protected string $publishAt;
    protected string $status;

    /**
     * @param int|NULL $userId
     * @param int|NULL $postId
     * @param string|NULL $content
     * @param string|NULL $publishAt
     * @param string|NULL $status
     */
    public function __construct(int $userId=NULL, int $postId=NULL, string $content=NULL, string $publishAt=NULL, string $status=NULL)
    {
        $this->userId = $userId === NULL ? $this->userId : $userId;
        $this->postId = $postId  === NULL ? $this->postId : $postId;
        $this->content = $content  === NULL ? $this->content : $content;
        $this->publishAt = $publishAt  === NULL ? $this->publishAt : $publishAt;
        $this->status = $status  === NULL ? $this->status : $status;
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
     * @return string
     */
    public function getPublishAt(): string
    {
        return $this->publishAt;
    }

    /**
     * @param string $publishAt
     */
    public function setPublishAt(string $publishAt): void
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