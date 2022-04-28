<?php

namespace App\Controllers;

use App\Repository\DBConnexion;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    protected $twig;
    protected $db;
    private $loader;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //DB CONNEXION
        $db = new DBConnexion($_ENV['DB_NAME'], $_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

        $this->db = $db;
        //Parameter for the templates folder
        $this->loader = new FilesystemLoader(ROOT.'/P5_Blog_Guillaume_De_Backre/Templates');

        //Twig Environment
        $this->twig = new Environment($this->loader);
    }

    protected function getDBConnexion()
    {
        return $this->db;
    }

    //CHECK DATA VALIDITY
    public function validate(string $data): string
    {
        //NO EMPTY STRING
        if (strlen($data) < 1) {
            throw new \Exception("Empty string");
        }
        //NOT EXCEED 255 CHARACTERS
        elseif (strlen($data) > 255) {
            throw new \Exception("Exceed 255 characters");
        } else {
            return $data;
        }
    }

    //CHECK EMAIL VALIDITY
    public function checkEmailValidity(string $email): string
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        } else {
            throw new \Exception("Not a valid email");
        }
    }

    //CHECK STATUS VALIDITY
    public function checkStatusValidity(string $status): string
    {
        //NO EMPTY STRING
        if (strlen($status) < 1) {
            throw new \Exception("Empty string");
        }
        //NOT EXCEED 25 CHARACTERS
        elseif (strlen($status) > 25) {
            throw new \Exception("Exceed 255 characters");
        }
        //CHECK IT'S A MANAGED STATUS
        elseif (strcmp($status, 'admin') === 0 || strcmp($status, 'visitor') === 0) {
            return $status;
        } else {
            throw new \Exception("This status is not managed");
        }
    }
}
