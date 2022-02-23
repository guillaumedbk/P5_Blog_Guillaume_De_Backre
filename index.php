<?php

include 'controllers/post.php';
include 'controllers/users.php';

if(isset($_GET['action'])) {
    //ALL POSTS
    if($_GET['action'] == 'listPosts'){
        $posts = listPost();
        require('views/viewPosts.php');
    }
    //ONE POST
    elseif ($_GET['action'] == 'post'){
        if(isset($_GET['id']) && $_GET['id'] > 0){
           $post = post();
           require('views/viewPost.php');
        }else{
            echo 'Error: no id has been sent';
        }
    }
    //BLOGPOST FORM CREATION
    elseif($_GET['action'] == 'createBlogPost'){
        createBlogPost();
    }
    //BLOG POST CREATION
    elseif ($_GET['action'] == 'addPost'){
            if (!empty($_POST['author']) && !empty($_POST['title']) && !empty($_POST['chapo']) && !empty($_POST['content'])) {
                addPost($_POST['author'], $_POST['title'], $_POST['chapo'],  $_POST['content']);
            }
            else {
                echo 'Erreur : tous les champs ne sont pas remplis !';
            }
    }
    //MODIFY POST
    elseif ($_GET['action'] == 'modifyPost'){
        if(isset($_GET['id']) && $_GET['id'] > 0){
            $post = post();
            require('views/viewModifyPost.php');
        }else{
            echo 'Error: no id has been sent';
        }
    }
    //MODIFY BLOG POST
    elseif ($_GET['action'] == 'modifyBlogPost'){
        if(isset($_GET['id']) && $_GET['id'] > 0){

            $postId = $_GET['id'];
            $author = $_POST['author'];
            $title = $_POST['title'];
            $chapo = $_POST['chapo'];
            $content = $_POST['content'];

            if(!empty($author) && !empty($title) && !empty($chapo) && !empty($content)){
               $postModified = modifyPost($postId, $title, $chapo, $content);
            }else{
                echo 'Error: all fields must be complete';
            }
        }else{
            echo 'Error: no id has been sent';
        }
    }
    //DELETE POST
    elseif ($_GET['action'] == 'deletePost'){
        if(isset($_GET['id']) && $_GET['id'] > 0){
            $postId = $_GET['id'];
            deletePost($postId);
            header('Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php?action=administration');
        }else{
            echo 'Error: no id has been sent';
        }
    }
    //SIGNUP FORM
    elseif($_GET['action'] == 'signIn'){
        require('views/viewSignIn.php');
    }
    //USER REGISTRATION
    elseif ($_GET['action'] == 'addUser'){
        //Check if field are well filled
        if (!empty($_POST['firstname']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){
            //Mail Filter
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

                //Check if mail already exist in db
                $mail = $_POST['email'];
                $checkMailExist = mailExistBdd($mail);

                if($checkMailExist == 0 ){
                    addUser($_POST['firstname'], $_POST['name'], $_POST['email'], 'utilisateur', $_POST['bio'], sha1($_POST['password']));
                }else{
                   echo 'Adresse mail déjà enregistrée';
                }
            }
            else{
                echo 'Erreur: Veuillez entrer un mail valide';
            }
        }
        else {
            echo 'Erreur : Veuillez renseigner tous les champs !';
        }
    }
    //CONNECT FORM
    elseif($_GET['action'] == 'connectForm'){
        require('views/viewLogIn.php');
    }
    //DISCONNECT FORM
    elseif($_GET['action'] == 'disconnect'){
    require('views/viewDisconnect.php');
    }
    //USER CONNEXION
    elseif ($_GET['action'] == 'connectUser'){

        if(isset($_POST['connectform'])){
            //Check if fields are filled
            if(!empty($_POST['email']) && !empty($_POST['password'])){
                //Mail Filter
                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    $mail = $_POST['email'];
                    $password = sha1($_POST['password']);
                    $userExist = userExistBdd($mail, $password);
                    $user = userInfos($mail, $password);

                    if($userExist == 1){
                        session_start();
                        $_SESSION['LOGGED'] = true;
                        $_SESSION['ID'] = $user['id'];
                        $_SESSION['FIRSTNAME'] = $user['firstname'];
                        $_SESSION['NAME'] = $user['name'];
                        $_SESSION['STATUS'] = $user['status'];
                        header('Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php?action=listPosts');
                    }
                    else{
                        echo 'mauvais mail ou mot de passe';
                    }

                }else{
                    echo 'Adresse mail non valide';
                }
            }else{
                echo 'Tous les champs doivent être remplis';
            }
        }
    }
    //ADMINISTRATION
    elseif ($_GET['action'] == 'administration') {
        $posts = listPost();
        $users = allUsers();
        require('views/viewAdministration.php');
    }
}else{
    listUsers();
}

$req = getPosts();


