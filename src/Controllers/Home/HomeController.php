<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Entity\User\User;
use App\Repository\DBConnexion;
use App\Router\Request;
use Twig\Extension\AbstractExtension;

class HomeController extends Controller
{

    public function __invoke(Request $request)
    {
        //DB CONNEXION
        $db = new DBConnexion($_ENV['DB_NAME'], $_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

        //GET ALL USER
        $req = $db->getPDO()->query('SELECT * FROM user');
        $users = $req->fetchAll();

        //DISPLAY TEMPLATE AND SEND VARIABLES
        $template = $this->twig->load('home/index.html.twig');
        echo $template->render([
            'user' => $users
        ]);
    }
}