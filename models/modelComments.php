<?php
//Add comment
function createComment($userId, $postId, $content){
    $db = dbConnect();
    $createComment = $db -> prepare('INSERT INTO comments(userId, postId, content, publishAt) VALUES(?, ?, ?, NOW())');

    return $createComment -> execute(array($userId, $postId, $content));
}