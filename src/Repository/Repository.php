<?php

namespace App\Repository;

use App\Controllers\Home\HomeController;
use App\Repository\DBConnexion;
use PDO;

abstract class Repository
{
    protected DBConnexion $dbConnection;
    protected $table;
    protected $entity;

    public function __construct(DBConnexion $dbConnection, $table, $entity)
    {
        $this->dbConnection = $dbConnection;
        $this->table = $table;
        $this->entity = $entity;
    }
    //GET ALL
    public function All(): array
    {
        $req = $this->dbConnection->getPDO()->query("SELECT * FROM {$this->table}");
        return $req->fetchAll(PDO::FETCH_CLASS, $this->entity);
    }

    //GET BY ID
    public function findById(int $id): object
    {
        $req = $this->dbConnection->getPDO()->prepare("SELECT id, firstname, name, email, status, bio, password FROM {$this->table} WHERE id = ?");
        $req->execute([$id]);

        return $req->fetchObject($this->entity);
    }
    //DELETE ONE ELEMENT
    public function deleteById(int $id)
    {
        $req = $this->dbConnection->getPDO()->prepare("DELETE FROM {$this->table} WHERE id = ?");

        if($req->execute([$id])){
            return "L\'élément $id de la table {$this->table} a été supprimé avec succès";
        }else{
            return "An error has occured";
        }
    }

}