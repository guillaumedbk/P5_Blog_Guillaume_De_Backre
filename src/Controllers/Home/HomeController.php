<?php

namespace App\Controllers\Home;

use App\Entity\User\User;
use App\Repository\DBConnexion;
use App\Router\Request;
use Twig\Extension\AbstractExtension;

class HomeController
{

    public function __invoke(Request $request)
    {
       // return $this->twig->display('home/index.html.twig', compact($users));
        $entreprise = array("nom"=>"guillaume");
        return $this->render('home/index.html.twig',
           ['entreprise' => $entreprise]
        );

    }

    public function show(int $id)
    {
        $db = new DBConnexion($_ENV['DB_NAME'],$_ENV['DB_HOST'],$_ENV['DB_USERNAME'],$_ENV['DB_PASSWORD']);
        var_dump($db->getPDO());
        return $this->twig->display('home/user.html.twig', compact('id'));
    }

}