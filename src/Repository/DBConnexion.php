<?php

namespace App\Repository;

use App\Exceptions\CustomException;
use PDO;
use PDOException;
use App\Repository\FileLogger;

class DBConnexion
{
    private string $dbname;
    private string $host;
    private string $username;
    private string $password;
    private $pdo;

    public function __construct(string $dbname, string $host, string $username, string $password)
    {
        $this->dbname = $dbname;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    public function getPDO(): PDO
    {
        if ($this->pdo === null) {
            //Instantiate pdo if null
            try {
                $this->pdo = new PDO("mysql:dbname={$this->dbname};host={$this->host}", $this->username, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
                ]);
            } catch (PDOException $exception) {
                $logger = new FileLogger('logger.log');
                $logger->critical("Connexion failure to bdd: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
                throw new PDOException("Connexion failure to bdd:  {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
            }
        }
        return $this->pdo;
    }
}
