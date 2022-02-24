<?php
//Add comment
function createComment($userId, $postId, $content){
    $db = dbConnect();
    $createComment = $db -> prepare('INSERT INTO comments(userId, postId, content, publishAt, status) VALUES(?, ?, ?, NOW(), "attente")');

    return $createComment -> execute(array($userId, $postId, $content));
}
//Get comment from one post
function getOnePostComment($postId){
    $db = dbConnect();
    $reqComment = $db -> prepare('SELECT * FROM comments WHERE postId = ? AND status = "accepted"');
    $reqComment -> execute(array($postId));

    return $reqComment->fetchAll();
}
//Get waiting comments
function waitingComments(){
    $db = dbConnect();
    $reqWaiting = $db -> prepare('SELECT * FROM comments WHERE status = "attente"');
    $reqWaiting -> execute();

    return $reqWaiting->fetchAll();
}
//Delete comment
function deleteOneComment($commentId){
    $db = dbConnect();
    $req = $db -> prepare('DELETE FROM comments WHERE id = ?');

    return $req -> execute(array($commentId));
}
//Accept comment
function acceptOneComment($commentId){
    $db = dbConnect();
    $reqReplace = $db -> prepare('UPDATE comments SET status = "accepted" WHERE id = ?');

    return $reqReplace -> execute(array($commentId));
}