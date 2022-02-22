<?php
//Database connexion
function dbConnect()
{
    try
    {
        return new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
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

    return $req->fetchAll();
}
//Get one post
function getPost($postId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM post WHERE id = ?');
    $req->execute(array($postId));

    return $req->fetch();
}

//Create post
function createPost($author, $title, $chapo, $content){
    $db = dbConnect();
    $createPost = $db -> prepare('INSERT INTO post(userId, title, chapo, content, lastUpdate) VALUES(?, ?, ?, ?, NOW())');

    return $createPost -> execute(array($author, $title, $chapo, $content));
}

