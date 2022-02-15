<?php

require('controllers/post.php');

if(isset($_GET['action'])) {
    if($_GET['action'] == 'listPosts'){
        listPost();
    }
    elseif($_GET['action'] == 'signIn'){
        require('views/viewSignIn.php');
    }
    elseif ($_GET['action'] == 'post'){
        if(isset($_GET['id']) && $_GET['id'] > 0){
            post();
        }else{
            echo 'Error: no id has been sent';
        }
    }
    if($_GET['action'] == 'createBlogPost'){
        createBlogPost();
    }
    elseif ($_GET['action'] == 'addPost'){
            if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['chapo']) && !empty($_POST['content'])) {
                addPost($_POST['author'], $_POST['title'], $_POST['chapo'],  $_POST['content']);
            }
            else {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
    }
    elseif ($_GET['action'] == 'addUser'){
        if (!empty($_POST['firstname']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                addUser($_POST['firstname'], $_POST['name'], $_POST['email'], 'utilisateur', $_POST['bio'], sha1($_POST['password']));
            }
            else{
                echo 'Erreur: Veuillez entrer un mail valide';
            }

        }
        else {
            echo 'Erreur : Veuillez renseigner tous les champs !';
        }
    }
}else{
    listUsers();
}

$req = getPosts();


