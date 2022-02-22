<?php
include('models/dbConnect.php');
//All posts
function getPosts()
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM post ORDER BY lastUpdate DESC');
    $req->execute();

    return $req->fetchAll();
}
//Get one post
function getPost($postId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT * FROM post WHERE id = ?');
    $req->execute(array($postId));

    return $req->fetch();
}

//Create post
function createPost($author, $title, $chapo, $content){
    $db = dbConnect();
    $createPost = $db -> prepare('INSERT INTO post(userId, title, chapo, content, lastUpdate) VALUES(?, ?, ?, ?, NOW())');

    return $createPost -> execute(array($author, $title, $chapo, $content));
}
//Delete post
function modifyBlogPost($postId, $title, $chapo, $content){
    $db = dbConnect();
    $modifyPost = $db -> prepare('UPDATE post SET title = :title, chapo = :chapo, content = :content, lastUpdate = NOW() WHERE id = ?');

    return $modifyPost -> execute(array('title' => $title, 'chapo' => $chapo, 'content' => $content, 'id' => $postId));
}

