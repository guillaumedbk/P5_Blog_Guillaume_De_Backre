<?php

namespace App\Validator\Asserts;

use App\Repository\DBConnexion;
use App\Repository\UserRepository;
use App\Validator\AssertInterface;

class AssertEmail implements AssertInterface
{
    public $DBConnexion;

    public function __construct()
    {
        //DB CONNEXION
        $db = new DBConnexion($_ENV['DB_NAME'], $_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        $this->db = $db;
    }
    public function __invoke($value): ?string
    {
        $userRepo = new UserRepository($this->db);

        if ($value === null || $value === '') {
            return null;
        }

        if ($userRepo->mailExist($value) === true) {
            return 'Mail already exist in db';
        }

        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            return 'Not valid email';
        }
        return null;
    }
}
