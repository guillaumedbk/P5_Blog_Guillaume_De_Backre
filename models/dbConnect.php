<?php
//Database connexion
function dbConnect()
{
    try
    {
        return new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        die('Error : '.$e->getMessage());
    }
}