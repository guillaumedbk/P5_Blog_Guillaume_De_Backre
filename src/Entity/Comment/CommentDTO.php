<?php

namespace App\Entity\Comment;

class CommentDTO
{
    public int $userId;
    public int $postId;
    public string $comment;
}