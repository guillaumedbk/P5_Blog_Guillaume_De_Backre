<?php

namespace App\Controllers\Blog;


use App\Controllers\Controller;
use App\Repository\DBConnexion;
use App\Router\Request;
use Twig\Extension\AbstractExtension;

class MyPutController extends Controller
{
    public function __invoke(Request $request)
    {
        $template = $this->twig->load('home/user.html.twig');
        echo $template->render([
            'firstname' => 'John',
        ]);

        $db = new DBConnexion($_ENV['DB_NAME'], $_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
        $req = $db->getPDO()->query('SELECT * FROM user');
        $users = $req->fetchAll();

    }

}