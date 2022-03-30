<?php

namespace App\Repository;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    private $loader;
    protected $twig;

    public function __construct()
    {
        //Parameter for the templates folder
        $this->loader = new FilesystemLoader(ROOT.'/P5_Blog_Guillaume_De_Backre/Templates');

        //Twig Environment
        $this->twig = new Environment($this->loader);
    }
}