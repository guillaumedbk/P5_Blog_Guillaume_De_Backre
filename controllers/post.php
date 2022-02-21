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
       header('Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php?action=listPosts');
    }
}
//Add user
function addUser($firstname, $name, $email, $status, $bio, $password)
{
    $affected = signIn($firstname, $name, $email, $status, $bio, $password);
    if($affected == false){
        die('Impossible d\'ajouter l\'utilisateur');
    }
    else{
        listUsers();
    }
}
//User connexion
function userExistBdd($mail, $password){
    $userExist = userConnect($mail, $password);
    return $userExist;
}
//User info
function userInfos($mail, $password){
    $userInfos = getUserInfos($mail, $password);
    return $userInfos;
}
//Check if mail already exist
function mailExistBdd($mail){
    $mailExist = mailExist($mail);
    return $mailExist;
}
//Go to blogpost creation form
function createBlogPost()
{
    require('views/viewCreatePost.php');
}


