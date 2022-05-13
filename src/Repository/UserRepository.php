<?php

namespace App\Repository;

use App\Entity\EntityInterface;
use App\Entity\User\User;
use App\Entity\User\UserLoginDTO;
use App\Entity\User\UserSignUpDTO;
use App\Exceptions\EntityNotFoundException;
use App\Repository\DBConnexion;
use Exception;
use PDO;

class UserRepository extends Repository
{
    //ATTRIBUTES
    protected string $table = 'user';

    //CONSTRUCTOR
    public function __construct(DBConnexion $dbConnection)
    {
        parent::__construct($dbConnection, $this->table, User::class);
    }

    //CREATE NEW USER BY PASSING AN OBJECT
    public function createUser(User $user): bool
    {
        try {
            $insertInto = $this->dbConnection->getPDO()->prepare('INSERT INTO user (firstname, name, email, status, bio, password) VALUES (?,?,?,?,?,?)');
            return $insertInto ->execute([$user->getFirstname(), $user->getName(), $user->getEmail(), $user->getStatus(), $user->getBio(), $user->getPassword()]);
        } catch (\PDOException $exception) {
            $logger = new FileLogger('logger.log');
            $logger->critical("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
            throw new \PDOException("The following error has occured:  {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }
    //MODIFY ONE USER
    public function modifyUser(User $user, $userId): bool
    {
        try {
            $modifyUser = $this->dbConnection->getPDO()->prepare('UPDATE user SET firstname = :firstname, name = :name, email = :email, bio = :bio, password = :password WHERE id = :id');

            return $modifyUser->execute([
                    'firstname' => $user->getFirstname(),
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'bio' => $user->getBio(),
                    'password' => $user->getPassword(),
                    'id' => $userId
                ]);
        } catch (\PDOException $exception) {
            $logger = new FileLogger('logger.log');
            $logger->critical("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
            throw new \PDOException("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }
    //MODIFY USER STATUS
    public function modifyUserStatus(User $user, $userId): bool
    {
        try {
            $req = $this->dbConnection->getPDO()->prepare('UPDATE user SET status = :status WHERE id = :id');
            return $req-> execute(['status' => $user->getStatus(), 'id' => $userId]);
        } catch (\PDOException $exception) {
            throw new \PDOException("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }

    //FIND BY EMAIL
    public function findByEmail(string $email): ?object
    {
        $req = $this->dbConnection->getPDO()->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $req->execute([$email]);
        $fetch = $req->fetch(PDO::FETCH_ASSOC);
        if ($fetch === false) {
            return null;
        }

        /** @var EntityInterface $entityClass */
        $entityClass = $this->entityClass;
        return $entityClass::createFromDb($fetch);
    }
    //CHECK IF MAIL EXIST IN DB
    public function mailExist(string $email): bool
    {
        try {
            $req = $this->dbConnection->getPDO()->prepare("SELECT * FROM {$this->table} WHERE email = ?");
            $req->execute(array($email));
            return $req->rowCount();
        } catch (\PDOException $exception) {
            throw new \PDOException("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }
    //GET LAST ID
    public function getId(string $email): array
    {
        $req = $this->dbConnection->getPDO()->prepare("SELECT id FROM {$this->table} WHERE email = ?");
        $req->execute(array($email));
        return $req->fetch(PDO::FETCH_ASSOC);
    }
}
