<?php

namespace App\Repository;

use App\Controllers\Home\HomeController;
use App\Entity\EntityInterface;
use App\Repository\DBConnexion;
use PDO;

/**
 * @template T
 */
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
     * @psalm-return list<T>
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
            return 'The following error has occured :' . $exception->getMessage() . ' at ligne ' . $exception->getLine() . ' in the following file: ' . $exception->getFile();
        }
    }
    //GET BY ID
    /**
     * @return object
     * @psalm-return T
     */
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
    public function deleteById(int $id)
    {
        $req = $this->dbConnection->getPDO()->prepare("DELETE FROM {$this->table} WHERE id = ?");

        if ($req->execute([$id])) {
            return "L\'élément $id de la table {$this->table} a été supprimé avec succès";
        } else {
            return "An error has occured";
        }
    }
    /**
     * @param array $element
     * @return object
     */
    public function hydrate(array $element): object
    {
        $object = (object) $element;
        return $object;
    }
    // abstract function hydrate(array $element): object;
}
