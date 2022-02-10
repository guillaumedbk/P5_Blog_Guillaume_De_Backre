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
    //$user = getUser(1);
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



