<?php

namespace App\Entity\Post;

use App\Entity\EntityInterface;

class Post implements EntityInterface
{
    //Attributes
    private ?int $id = null;
    private int $userId;
    private string $title;
    private string $chapo;
    private string $content;

    //Constructor
    public function __construct(int $userId=null, string $title=null, string $chapo=null, string $content=null)
    {
        $this->userId = $userId;
        $this->title = $title;
        $this->chapo = $chapo;
        $this->content = $content;
    }

    //Retrieves the array with the data from the db and returns an object
    public static function createFromDb(array $element): self
    {
        $post = new Post($element['userId'], $element['title'], $element['chapo'], $element['content']);
        $post->id = $element['id'];
        return $post;
    }

    //Getters and setters
    public function getUserId(): ?int
    {
        return $this->userId;
    }
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getChapo(): ?string
    {
        return $this->chapo;
    }
    public function setChapo(?string $chapo): void
    {
        $this->chapo = $chapo;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }
}
