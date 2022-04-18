<?php
namespace App\Entity\Post;

class Post
{
    //Attributes
    private int $userId;
    private string $title;
    private string $chapo;
    private string $content;

    /**
     * @param int|NULL $userId
     * @param string|NULL $title
     * @param string|NULL $chapo
     * @param string|NULL $content
     */
      public function __construct(int $userId=NULL, string $title=NULL, string $chapo=NULL, string $content=NULL)
      {
          $this->userId = $userId === NULL ? $this->userId: $userId;
          $this->title = $title === NULL ? $this->title : $title;
          $this->chapo = $chapo === NULL ? $this->chapo : $chapo;
          $this->content = $content === NULL ? $this->content : $content;
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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getChapo(): string
    {
        return $this->chapo;
    }

    /**
     * @param string $chapo
     */
    public function setChapo(string $chapo): void
    {
        $this->chapo = $chapo;
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


}