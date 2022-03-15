<?php
include 'controllers/post.php';
include 'controllers/users.php';
include 'controllers/comment.php';

define('ERROR_NOID', 'no id has been sent');
define('ADMINISTRATION_PAGE', 'Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php?action=administration');

if(isset($_GET['action'])) {
    //ALL POSTS
    if($_GET['action'] == 'listPosts'){
        $posts = listPost();
        require('views/viewPosts.php');
    }
    //ONE POST
    elseif ($_GET['action'] == 'post'){
        if(isset($_GET['id']) && $_GET['id'] > 0){
            $postId = $_GET['id'];
            $comments = getPostComment($postId);
            $post = post();
            require('views/viewPost.php');
        }else{
            $error = constant('ERROR_NOID');
            require('views/viewError.php');
        }
    }
    //BLOGPOST FORM CREATION
    elseif($_GET['action'] == 'createBlogPost'){
        require('views/viewCreatePost.php');
    }
    //BLOG POST CREATION
    elseif ($_GET['action'] == 'addPost'){
        $authorId = $_GET['id'];
            if (!empty($_POST['title']) && !empty($_POST['chapo']) && !empty($_POST['content'])) {
                addPost($authorId, $_POST['title'], $_POST['chapo'],  $_POST['content']);
            }
            else {
                $error = 'Erreur : tous les champs ne sont pas remplis !';
                require('views/viewError.php');
            }
    }
    //ADD COMMENT
    elseif ($_GET['action'] == 'addComment'){
        $userId = $_GET['userId'];
        $postId = $_GET['postId'];
        $content = $_POST['comment'];
        if (!empty($content)){
            addComment($userId, $postId, $content);
        }
        else {
            $error = 'Erreur : tous les champs ne sont pas remplis !';
            require('views/viewError.php');
        }
    }
    //MODIFY POST
    elseif ($_GET['action'] == 'modifyPost'){
        if(isset($_GET['id']) && $_GET['id'] > 0){
            $post = post();
            require('views/viewModifyPost.php');
        }else{
            $error = constant('ERROR_NOID');
            require('views/viewError.php');
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
                header('Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php?action=listPosts');
            }else{
                $error = 'Error: all fields must be complete';
                require('views/viewError.php');
            }
        }else{
            $error = constant('ERROR_NOID');
            require('views/viewError.php');
        }
    }
    //DELETE POST
    elseif ($_GET['action'] == 'deletePost'){
        if(isset($_GET['id']) && $_GET['id'] > 0){
            $postId = $_GET['id'];
            deletePost($postId);
            header(constant('ADMINISTRATION_PAGE'));
        }else{
            $error = constant('ERROR_NOID');
            require('views/viewError.php');
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
                    $error = 'Adresse mail déjà enregistrée';
                    $solution =  '<a href="?action=connectForm">Veuillez vous connecter</a>';
                    require('views/viewError.php');
                }
            }
            else{
                $error = 'Veuillez entrer un mail valide';
                require('views/viewError.php');
            }
        }
        else {
            $error = 'Veuillez renseigner tous les champs !';
            require('views/viewError.php');
        }
    }
    //MODIFY USER
    elseif ($_GET['action'] == 'modifyUser'){
        if(isset($_GET['id']) && $_GET['id'] > 0){
            $userId = $_GET['id'];
            $user = getUser($userId);
            require('views/viewModifyUser.php');
        }else{
            $error = constant('ERROR_NOID');
            require('views/viewError.php');
        }
    }
    //MODIFY DATA USER
    elseif ($_GET['action'] == 'modifyOneUser'){
        if(isset($_GET['id']) && $_GET['id'] > 0){

            $userId = $_GET['id'];
            $firstname = $_POST['firstname'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $bio = $_POST['bio'];
            $password = sha1($_POST['password']);

            if(!empty($firstname) && !empty($name) && !empty($email) && !empty($bio) && !empty($password)){
                $userModified = modifyUser( $userId, $firstname, $name, $email, $bio, $password);
                header(constant('ADMINISTRATION_PAGE'));
            }else{
                $error = 'Error: all fields must be complete';
                require('views/viewError.php');
            }
        }else{
            $error = constant('ERROR_NOID');
            require('views/viewError.php');
        }
    }
    //MODIFY DATA USER
    elseif ($_GET['action'] == 'modifyStatus'){
        if(isset($_GET['id']) && $_GET['id'] > 0){
            $userId = $_GET['id'];
            $newStatus = $_GET['status'];
            if(isset($newStatus)){
                modifyStatus($userId, $newStatus);
                header(constant('ADMINISTRATION_PAGE'));
            }else{
                $error = 'Error: no status has been mentionned';
                require('views/viewError.php');
            }

        }else{
            $error = constant('ERROR_NOID');
            require('views/viewError.php');
        }
    }
    //DELETE USER
    elseif ($_GET['action'] == 'deleteUser'){
        if(isset($_GET['id']) && $_GET['id'] > 0){
            $userId = $_GET['id'];
            deleteUser($userId);
            header(constant('ADMINISTRATION_PAGE'));
        }else{
            $error = constant('ERROR_NOID');
            require('views/viewError.php');
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
                        $error = 'mauvais mail ou mot de passe';
                        $solution =  '<a href="?action=connectForm">Tenter à nouveau</a>';
                        require('views/viewError.php');
                    }

                }else{
                    $error = 'Adresse mail non valide';
                    require('views/viewError.php');
                }
            }else{
                $error = 'Tous les champs doivent être remplis';
                require('views/viewError.php');
            }
        }
    }
    //ADMINISTRATION
    elseif ($_GET['action'] == 'administration') {
        $waitingComments = getWaitingComments();
        $posts = listPost();
        $users = allUsers();
        require('views/viewAdministration.php');
    }
    //DELETE COMMENT
    elseif ($_GET['action'] == 'deleteComment') {
        $commentId = $_GET['id'];
        deleteComment($commentId);
        header(constant('ADMINISTRATION_PAGE'));
    }
    //ACCEPT COMMENT
    elseif ($_GET['action'] == 'acceptComment') {
        if(isset($_GET['id']) && $_GET['id'] > 0) {
            $commentId = $_GET['id'];
            acceptComment($commentId);
            header(constant('ADMINISTRATION_PAGE'));
        }else{
            $error = 'no id has been sent';
            require('views/viewError.php');
        }
    }
}else{
    $user = getUser(1);
    require('views/viewHomePage.php');
}

$req = getPosts();


