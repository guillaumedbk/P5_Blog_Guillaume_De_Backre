<?php
//Database connexion
function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
        return $db;
    }
    catch(Exception $e)
    {
        die('Error : '.$e->getMessage());
    }
}
//All posts
function getPosts()
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM post');
    $req->execute();
    $posts = $req->fetchAll();

    return $posts;
}
//Get one post
function getPost($postId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id, title, chapo FROM post WHERE id = ? ORDER BY lastUpdate DESC');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}

//Get users
function getUsers()
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM user WHERE id = 1');
    $req->execute();
    $users = $req->fetchAll();

    return $users;
}