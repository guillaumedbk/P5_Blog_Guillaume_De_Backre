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

    protected function hydrate(array $donnees, $dto): object
    {
        foreach ($donnees as $key => $value) {
            //We get the name of the corresponding setter
            $method = 'set'.ucfirst($key);
            //If the corresponding setter exists
            if (method_exists($dto, $method)) {
                //We call the setter and give it its value
                $dto->$method($value);
            } else {
                return 'Method doesn\'t exist';
            }
        }
        return $dto;
    }
}
