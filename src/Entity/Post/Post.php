<?php
namespace App\Entity\Post;

class Post
{
    //Attributes
    private $userId;
    private $title;
    private $chapo;
    private $content;
    private $latsUpdate;

    /**
     * @param $userId
     * @param $title
     * @param $chapo
     * @param $content
     * @param $latsUpdate
     */
    public function __construct($userId=NULL, $title=NULL, $chapo=NULL, $content=NULL, $latsUpdate=NULL)
    {
        $this->userId = $userId === NULL ? $this->userId : $userId;
        $this->title = $title === NULL ? $this->title : $title;
        $this->chapo = $chapo === NULL ? $this->chapo : $chapo;
        $this->content = $content === NULL ? $this->content : $content;
        $this->latsUpdate = $latsUpdate === NULL ? $this->latsUpdate : $latsUpdate;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * @param mixed $chapo
     */
    public function setChapo($chapo): void
    {
        $this->chapo = $chapo;
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
    public function getLatsUpdate()
    {
        return $this->latsUpdate;
    }

    /**
     * @param mixed $latsUpdate
     */
    public function setLatsUpdate($latsUpdate): void
    {
        $this->latsUpdate = $latsUpdate;
    }
}