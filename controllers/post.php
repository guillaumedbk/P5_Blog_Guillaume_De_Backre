<?php

require('models/model.php');

//All post
function listPost()
{
    $posts = getPosts();
    require('views/viewPosts.php');
}
//Get one post
function post()
{
    $post = getPost($_GET['id']);
    require('views/viewPost.php');
}
//All users
function listUsers()
{
    $users = getUsers();
    require('views/viewHomePage.php');
}
//One user
function user()
{
    $user = getUser();
    require('views/viewPost.php');
}
//Create post
function addPost($author, $title, $chapo, $content)
{
    $affectedLines = createPost($author, $title, $chapo, $content);

    if($affectedLines == false){
        die('Impossible d\'ajouter le post !');
    }
    else{
       //require('views/viewPosts.php');
       header('Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php?action=listPosts');
    }
}
function createP()
{
    require('views/viewCreatePost.php');
}


