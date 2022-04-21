<?php

namespace App\Repository;

use App\Controllers\Home\HomeController;
use App\Entity\EntityInterface;
use App\Repository\DBConnexion;
use PDO;

abstract class Repository
{
    protected DBConnexion $dbConnection;
    protected string $table;
    private string $entity;

    public function __construct(DBConnexion $dbConnection, string $table, string $entity)
    {
        $this->dbConnection = $dbConnection;
        $this->table = $table;
        $this->entity = $entity;
    }
    //GET ALL
    /**
     * @return array<object>
     */
    public function all(): array
    {
        try {
            $req = $this->dbConnection->getPDO()->query("SELECT * FROM {$this->table}");
            $fetchAll = $req->fetchAll(PDO::FETCH_ASSOC);
            $result = [];
            foreach ($fetchAll as $item) {
                $result[] = $this->hydrate($item);
            }
            return $result;
        } catch (\PDOException $exception) {
            throw new \PDOException("The following error has occured:  {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }
    //GET BY ID
    public function findById(int $id): object
    {
        $req = $this->dbConnection->getPDO()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $req->execute([$id]);
        $fetch = $req->fetch(PDO::FETCH_ASSOC);

        /** @var EntityInterface $entity */
        $entity = $this->entity;
        return $entity::createFromDb($fetch);
    }
    //DELETE ONE ELEMENT
    public function deleteById(int $id): bool
    {
        try {
            $req = $this->dbConnection->getPDO()->prepare("DELETE FROM {$this->table} WHERE id = ?");
            return $req->execute([$id]);
        } catch (\PDOException $exception) {
            throw new \Exception("The following error has occured: {$exception->getMessage()}, we couldn't delete the element with id: {$id}");
        }
    }
    //ARRAY TO OBJECT
    public function hydrate(array $element): object
    {
        $object = (object) $element;
        return $object;
    }
}
