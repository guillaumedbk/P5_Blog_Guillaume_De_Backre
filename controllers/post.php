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
//All post
function listUsers()
{
    $users = getUsers();
   // require('views/viewHomePage.php');
    require('views/viewHomePage.php');
}


