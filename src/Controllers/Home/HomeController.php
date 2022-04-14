<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Entity\User\User;
use App\Repository\DBConnexion;
use App\Repository\UserRepository;
use App\Router\Request;
use Twig\Extension\AbstractExtension;

class HomeController extends Controller
{

    public function __invoke(Request $request)
    {
        $oneUser = new UserRepository($this->getDBConnexion());
        $theUser = $oneUser->findById(1);

        //DISPLAY TEMPLATE AND SEND VARIABLES
        $template = $this->twig->load('home/index.html.twig');
        echo $template->render([
            'user' => $theUser
        ]);

       // var_dump($request->getMatches());
    }
}