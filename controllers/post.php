<?php

include('models/modelPosts.php');

//All post
function listPost()
{
    return getPosts();
}
//Get one post
function post()
{
    return getPost($_GET['id']);
}
//Create post
function addPost($author, $title, $chapo, $content)
{
    $affectedLines = createPost($author, $title, $chapo, $content);

    if(!$affectedLines){
        die('Impossible d\'ajouter le post !');
    }
    else{
       header('Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php?action=listPosts');
    }
}
//Go to blogpost creation form
function createBlogPost()
{
    require('views/viewCreatePost.php');
}
//Modify Post
function modifyPost($postId, $title, $chapo, $content)
{
    return modifyBlogPost($postId, $title, $chapo, $content);
}


