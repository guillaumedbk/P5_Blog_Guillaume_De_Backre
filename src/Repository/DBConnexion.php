<?php

namespace App\Repository;

use PDO;
use PDOException;

class DBConnexion
{
    private string $dbname;
    private string $host;
    private string $username;
    private string $password;
    private $pdo;

    public function __construct(string $dbname, string $host, string $username,string $password)
    {
        $this->dbname = $dbname;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    public function getPDO(): PDO
    {
        if($this->pdo === null){
            //Instantiate pdo if null
            try{
                $this->pdo = new PDO("mysql:dbname={$this->dbname};host={$this->host}", $this->username, $this->password, array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
                ));
            }catch(PDOException $Exception){
                echo 'Connection failure :' . $Exception->getMessage() . ' at ligne ' . $Exception->getLine() . ' in the following file: ' . $Exception->getFile();
            }
        }
        return $this->pdo;
    }

}