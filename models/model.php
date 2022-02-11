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
    $req = $db->prepare('SELECT * FROM post ORDER BY lastUpdate DESC');
    $req->execute();
    $posts = $req->fetchAll();

    return $posts;
}
//Get one post
function getPost($postId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM post WHERE id = ?');
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
//Get user
function getUser($userId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM user WHERE id = ?');
    $req->execute(array($userId));
    $user = $req->fetch();

    return $user;
}
//Create post
function createPost($author, $title, $chapo, $content){
    $db = dbConnect();
    $createPost = $db -> prepare('INSERT INTO post(userId, title, chapo, content, lastUpdate) VALUES(?, ?, ?, ?, NOW())');
    $affectedLines = $createPost -> execute(array($author, $title, $chapo, $content));

    return $affectedLines;
}