<?php

abstract class Model
{
    private static $_bdd;

    //DB connection
    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf-8','root','root');

        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //instantiates the connection to the database
    protected function getBDD()
    {
        if(self::$_bdd == null)
        {
           self::setBdd();
           return self::$_bdd;
        }
    }

    //retrieve all data from a table
    protected function getAll($table, $obj)
    {
        $var = [];
        $req = $this->getBDD()->prepare('SELECT * FROM '.$table.' ORDER BY id desc ');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }
}