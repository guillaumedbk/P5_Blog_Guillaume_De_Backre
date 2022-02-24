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
function getPostComment($postId){
    return getOnePostComment($postId);
}
//Get waiting comments
function getWaitingComments(){
    return waitingComments();
}
//Delete comment
function deleteComment($commentId){
    return deleteOneComment($commentId);
}
//Accept comment
function acceptComment($commentId){
    return acceptOneComment($commentId);
}