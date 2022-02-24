<?php
//Add comment
function createComment($userId, $postId, $content){
    $db = dbConnect();
    $createComment = $db -> prepare('INSERT INTO comments(userId, postId, content, publishAt) VALUES(?, ?, ?, NOW())');

    return $createComment -> execute(array($userId, $postId, $content));
}
//Get comment from one post
function getOnePostComment($postId){
    $db = dbConnect();
    $reqComment = $db -> prepare('SELECT * FROM comments WHERE postId = ?');
    $reqComment -> execute(array($postId));

    return $reqComment->fetchAll();
}