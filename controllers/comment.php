<?php
include('models/modelComments.php');
//Add comment
function addComment($userId, $postId, $content){
    $affectedLines = createComment($userId, $postId, $content);

    if(!$affectedLines){
        die('Impossible d\'ajouter le commentaire!');
    }
    else{
        header('Location: http://localhost:8888/P5_Blog_Guillaume_De_Backre/index.php?action=listPosts');
    }
}
//Get comment from one post
function getPostComment(){
    
}