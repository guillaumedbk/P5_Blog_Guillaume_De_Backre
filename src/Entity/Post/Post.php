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

    public function __construct(int $userId=null, string $title=null, string $chapo=null, string $content=null)
    {
        $this->userId = $userId;
        $this->title = $title;
        $this->chapo = $chapo;
        $this->content = $content;
    }

    public static function createFromDb(array $element): self
    {
        $post = new Post($element['userId'], $element['title'], $element['chapo'], $element['content']);
        $post->id = $element['id'];
        return $post;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getChapo(): ?string
    {
        return $this->chapo;
    }

    /**
     * @param string|null $chapo
     */
    public function setChapo(?string $chapo): void
    {
        $this->chapo = $chapo;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }
}
