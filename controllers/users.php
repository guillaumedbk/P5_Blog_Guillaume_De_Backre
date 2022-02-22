<?php
include('models/modelUsers.php');

//User connexion
function userExistBdd($mail, $password){
    return userConnect($mail, $password);
}
//All users
function listUsers()
{
    $users = getUsers();
    require('views/viewHomePage.php');
}
//Add user
function addUser($firstname, $name, $email, $status, $bio, $password)
{
    $affected = signIn($firstname, $name, $email, $status, $bio, $password);
    if(!$affected){
        die('Impossible d\'ajouter l\'utilisateur');
    }
    else{
        listUsers();
    }
}
//Check if mail already exist
function mailExistBdd($mail)
{
    return mailExist($mail);
}
//User info
function userInfos($mail, $password){
    return getUserInfos($mail, $password);
}
function allUsers(){
    return getAllUsers();
}
//One user
function user()
{
    $user = getUser();
    require('views/viewPost.php');
}