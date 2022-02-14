<?php

require('controllers/post.php');

if(isset($_GET['action'])) {
    if($_GET['action'] == 'listPosts'){
        listPost();
    }
    elseif ($_GET['action'] == 'post'){
        if(isset($_GET['id']) && $_GET['id'] > 0){
            post();
        }else{
            echo 'Error: no id has been sent';
        }
    }
    if($_GET['action'] == 'createP'){
        createP();
    }
    elseif ($_GET['action'] == 'addPost'){
            if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['chapo']) && !empty($_POST['content'])) {
                addPost($_POST['author'], $_POST['title'], $_POST['chapo'],  $_POST['content']);
            }
            else {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
    }
}else{
    listUsers();
}

$req = getPosts();


