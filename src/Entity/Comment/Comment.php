<?php

namespace App\Entity\Comment;

class Comment
{
    //Attributes
    protected $userId;
    protected $postId;
    protected $content;
    protected $publishAt;
    protected $status;

    /**
     * @param $userId
     * @param $postId
     * @param $content
     * @param $publishAt
     * @param $status
     */
    public function __construct($userId=NULL, $postId=NULL, $content=NULL, $publishAt=NULL, $status=NULL)
    {
        $this->userId = $userId === NULL ? $this->userId : $userId;
        $this->postId = $postId  === NULL ? $this->postId : $postId;
        $this->content = $content  === NULL ? $this->content : $content;
        $this->publishAt = $publishAt  === NULL ? $this->publishAt : $publishAt;
        $this->status = $status  === NULL ? $this->status : $status;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param mixed $postId
     */
    public function setPostId($postId): void
    {
        $this->postId = $postId;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getPublishAt()
    {
        return $this->publishAt;
    }

    /**
     * @param mixed $publishAt
     */
    public function setPublishAt($publishAt): void
    {
        $this->publishAt = $publishAt;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }


}