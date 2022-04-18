<?php

namespace App\Repository;

use App\Entity\User\User;
use Exception;
use App\Exceptions\EntityNotFoundException;


class UserRepository extends Repository
{
    protected $table = 'user';

    public function __construct(\App\Repository\DBConnexion $dbConnection)
    {
        try{
            parent::__construct($dbConnection, $this->table, User::class);

            if(!$this->entity){
                throw new EntityNotFoundException($this->entity);
            }
        }catch(Exception $exception){
           $e = new EntityNotFoundException($this->entity);
           echo $e->getClass() . ': '. $exception->getMessage();
        }
    }

    //CREATE NEW USER BY PASSING AN OBJECT
    public function createUser(User $user)
    {
        try{
            $insertInto = $this->dbConnection->getPDO()->prepare('INSERT INTO user (firstname, name, email, status, bio, password) VALUES (?,?,?,?,?,?)');
            return $insertInto ->execute(array($user->getFirstname(), $user->getName(), $user->getEmail(), $user->getStatus(), $user->getBio(),$user->getPassword()));
        }
        catch(\PDOException $exception){
            echo 'The following error has occured :' . $exception->getMessage() . ' at ligne ' . $exception->getLine() . ' in the following file: ' . $exception->getFile();
    }
    }
    //MODIFY ONE USER
    public function modifyUser(User $user, $userId)
    {
        try{
            $modifyUser = $this->dbConnection->getPDO()->prepare('UPDATE user SET firstname = :firstname, name = :name, email = :email, bio = :bio, password = :password WHERE id = :id');
            if (
                $modifyUser->execute([
                    'firstname' => $user->getFirstname(),
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'bio' => $user->getBio(),
                    'password' => $user->getPassword(),
                    'id' => $userId
                ])) {
                return 'User successfully modified';
            }
        }
        catch(\PDOException $exception){
            echo 'The following error has occured :' . $exception->getMessage() . ' at ligne ' . $exception->getLine() . ' in the following file: ' . $exception->getFile();
        }
    }
    //MODIFY USER STATUS
    public function modifyUserStatus(User $user, $userId)
    {
        try{
            $req = $this->dbConnection->getPDO()->prepare('UPDATE user SET status = :status WHERE id = :id');
            return $req-> execute(['status' => $user->getStatus(), 'id' => $userId]);

        }catch(\PDOException $exception){
            echo 'The following error has occured :' . $exception->getMessage() . ' at ligne ' . $exception->getLine() . ' in the following file: ' . $exception->getFile();
        }
    }
}