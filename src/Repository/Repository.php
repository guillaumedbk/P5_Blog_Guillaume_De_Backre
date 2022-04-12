<?php

namespace App\Repository;

use App\Repository\DBConnexion;

abstract class Repository
{
    protected DBConnexion $dbConnection;
    protected $table;

    public function __construct(DBConnexion $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function All(): array
    {
        //GET ALL
        $req = $this->dbConnection->getPDO()->query("SELECT * FROM {$this->table}");
        return $req->fetchAll();
    }

    public function findById(int $id)
    {
        //GET ONE
        $req = $this->dbConnection->getPDO()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $req->execute([$id]);

        return json_decode(json_encode($req->fetch()), true);
    }
}