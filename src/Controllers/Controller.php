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

    //HYDRATE DTO
    protected function hydrate(array $donnees, $dto): object
    {
        foreach ($donnees as $key => $value) {
            $dto->$key = $value;
        }
        return $dto;
    }
}
