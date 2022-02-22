<?php
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
//Create user
function signIn($firstname, $name, $email, $status, $bio, $password){
    $db = dbConnect();
    $addUser = $db -> prepare('INSERT INTO user(firstname, name, email, status, bio, password) VALUES(?, ?, ?, ?, ?, ?)');

    return $addUser -> execute(array($firstname, $name, $email, $status, $bio, $password));
}
//User connexion
function userConnect($mail, $password){
    $db = dbConnect();
    $reqUser = $db->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
    $reqUser->execute(array($mail, $password));

    return $reqUser->rowCount();
}
//Check if mail exist
function mailExist($mail){
    $db = dbConnect();
    $reqMail = $db->prepare('SELECT * FROM user WHERE email = ?');
    $reqMail->execute(array($mail));

    return $reqMail->rowCount();
}

//Get user info
function getUserInfos($mail, $password){
    $db = dbConnect();
    $reqUser = $db->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
    $reqUser->execute(array($mail, $password));

    return $reqUser->fetch();
}