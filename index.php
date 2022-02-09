<?php

<<<<<<< HEAD
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
}else{
    listUsers();
   // header('Location: http://localhost:8888/Blog/views/startbootstrap-freelancer-gh-pages/');
}

$req = getPosts();


=======
require_once ('Controller/Router.php');

$router = new Router();
$router-> routeReq();
>>>>>>> main
