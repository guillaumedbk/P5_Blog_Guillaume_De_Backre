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
    protected string $entityClass;

    public function __construct(DBConnexion $dbConnection, string $table, string $entityClass)
    {
        $this->dbConnection = $dbConnection;
        $this->table = $table;
        $this->entityClass = $entityClass;
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
                //remove backslashes added by the addslashes method
                foreach ($item as &$element) {
                    $element = stripcslashes($element);
                }
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
        try {
            $req = $this->dbConnection->getPDO()->prepare("SELECT * FROM {$this->table} WHERE id = ?");
            $req->execute([$id]);
            $fetch = $req->fetch(PDO::FETCH_ASSOC);
            foreach ($fetch as &$element) {
                $element = stripcslashes($element);
            }

            /** @var EntityInterface $entityClass */
            $entityClass = $this->entityClass;
            return $entityClass::createFromDb($fetch);
        } catch (\PDOException $exception) {
            throw new \PDOException("The following error has occured:  {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }
    //DELETE ONE ELEMENT
    public function deleteById(int $id): void
    {
        $req = $this->dbConnection->getPDO()->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $req->execute([$id]);
    }
    //ARRAY TO OBJECT
    public function hydrate(array $element): object
    {
        $object = (object) $element;
        return $object;
    }
}
