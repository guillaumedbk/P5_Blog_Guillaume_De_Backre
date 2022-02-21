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
//Get users
function getUsers()
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM user WHERE id = 1');
    $req->execute();

    return $req->fetchAll();
}
//Get user
function getUser($userId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM user WHERE id = ?');
    $req->execute(array($userId));

    return $req->fetch();
}
//Create post
function createPost($author, $title, $chapo, $content){
    $db = dbConnect();
    $createPost = $db -> prepare('INSERT INTO post(userId, title, chapo, content, lastUpdate) VALUES(?, ?, ?, ?, NOW())');

    return $createPost -> execute(array($author, $title, $chapo, $content));
}
//Create user
function signIn($firstname, $name, $email, $status, $bio, $password){
    $db = dbConnect();
    $addUser = $db -> prepare('INSERT INTO user(firstname, name, email, status, bio, password) VALUES(?, ?, ?, ?, ?, ?)');

    return $addUser -> execute(array($firstname, $name, $email, $status, $bio, $password));
}
//Check if mail exist
function mailExist($mail){
    $db = dbConnect();
    $reqMail = $db->prepare('SELECT * FROM user WHERE email = ?');
    $reqMail->execute(array($mail));

    return $reqMail->rowCount();
}
//User connexion
function userConnect($mail, $password){
    $db = dbConnect();
    $reqUser = $db->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
    $reqUser->execute(array($mail, $password));

    return $reqUser->rowCount();
}
//Get user info
function getUserInfos($mail, $password){
    $db = dbConnect();
    $reqUser = $db->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
    $reqUser->execute(array($mail, $password));

    return $reqUser->fetch();
}