<?php

class PostManager extends Model
{
    public function getPosts()
    {
        $this->getBDD();
        return $this->getAll('post', 'Post');
    }
}