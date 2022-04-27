<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Router\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request): void
    {
        if ($request->getMethod() === "GET") {
            $this->getLoginController();
        } elseif ($request->getMethod() === "POST") {
            $userConnectInfo = $request->getUserConnectInfos();
            $this->postLoginController($userConnectInfo);
        }
    }

    public function getLoginController(): void
    {
        //DISPLAY TEMPLATE AND SEND VARIABLES
        $template = $this->twig->load('home/login.html.twig');
        echo $template->render();
    }

    public function postLoginController($userConnectInfo): void
    {
        var_dump($userConnectInfo);

    }
}
