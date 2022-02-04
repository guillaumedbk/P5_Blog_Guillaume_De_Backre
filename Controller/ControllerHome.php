<?php

class ControllerHome
{
    private $_postManager;
    private $_view;

    public function __construct($url)
    {
        if(isset($url)) {
            throw new Exception('Page not found');
        }
        else {
            $this->posts();
        }
    }
    private function posts()
    {
        $this->_postManager = new PostManager();
        $posts = $this->_postManager->getPosts();

        require_once ('View/viewHome.php');
    }
}