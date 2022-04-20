<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Repository\UserRepository;
use App\Router\Request;

class SignUpController extends Controller
{
    public function __invoke(Request $request)
    {
        /*
        //CREATE USER
        $createUser = new UserRepository($this->getDBConnexion());
        $createUser->createUser('guillaume', 'dbk', 'mail@mail', 'admin', 'une bio parfaite', 'test');
        */
        //DISPLAY TEMPLATE AND SEND VARIABLES
        $template = $this->twig->load('home/signUp.html.twig');
        echo $template->render();
    }
}
