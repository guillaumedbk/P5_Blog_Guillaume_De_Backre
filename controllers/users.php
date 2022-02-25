<?php
include('models/modelUsers.php');

//User connexion
function userExistBdd($mail, $password){
    return userConnect($mail, $password);
}
//All users
function listUsers()
{
    return getUsers();
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
//Get all users
function allUsers(){
    return getAllUsers();
}
//Get user
function getUser($userId){
    return getOneUser($userId);
}
//Modify user
function modifyUser($userId, $firstname, $name, $email, $bio, $password){
    return modifyOneUser($userId, $firstname, $name, $email, $bio, $password);
}
//Delete user
function deleteUser($userId){
    return deleteOneUser($userId);
}
//Modify user status
function modifyStatus($userId, $newStatus){
    return modifyUserStatus($userId, $newStatus);
}