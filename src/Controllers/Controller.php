<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Repository\DBConnexion;

abstract class Controller
{
    private $loader;
    protected $twig;
    protected $db;

    //public function __construct(DBConnexion $db)
    public function __construct($db)
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
}