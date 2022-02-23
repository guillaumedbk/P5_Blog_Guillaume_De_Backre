<?php

//Get my user
function getUsers()
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM user WHERE id = 1');
    $req->execute();

    return $req->fetchAll();
}
//Get my user
function getAllUsers()
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM user');
    $req->execute();

    return $req->fetchAll();
}
//Get user
function getOneUser($userId)
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
//Modify user
function modifyOneUser($userId, $firstname, $name, $email, $bio, $password){
    $db = dbConnect();
    $modifyUser = $db -> prepare('UPDATE user SET firstname = :firstname, name = :name, email = :email, bio = :bio, password = :password WHERE id = :id');

    return $modifyUser -> execute([
        'firstname' => $firstname,
        'name' => $name,
        'email' => $email,
        'bio' => $bio,
        'password' => $password,
        'id' => $userId]);
}
//Delete user
function deleteOneUser($userId){
    $db = dbConnect();
    $deleteUser = $db -> prepare('DELETE FROM user WHERE id = ?');

    return $deleteUser -> execute(array($userId));
}