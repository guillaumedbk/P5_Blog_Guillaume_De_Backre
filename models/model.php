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
//Create user
function signIn($firstname, $name, $email, $status, $bio, $password){
    $db = dbConnect();
    $addUser = $db -> prepare('INSERT INTO user(firstname, name, email, status, bio, password) VALUES(?, ?, ?, ?, ?, ?)');
    $affected = $addUser -> execute(array($firstname, $name, $email, $status, $bio, $password));

    return $affected;
}
//Check if mail exist
function mailExist($mail){
    $db = dbConnect();
    $reqMail = $db->prepare('SELECT * FROM user WHERE email = ?');
    $reqMail->execute(array($mail));
    $mailExist = $reqMail->rowCount();

    return $mailExist;
}