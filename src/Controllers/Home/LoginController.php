<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Repository\UserRepository;
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

    public function postLoginController($userConnectInfo)
    {
        //CHECK EMAIL VALIDITY
        $this->checkEmailValidity($userConnectInfo->getEmail());
        //CHECK PASSWORD ISN'T EMPTY
        $this->validate($userConnectInfo->getPassword());
        //CHECK IF DATA MATCHES
        $user = new UserRepository($this->getDBConnexion());
        $connect = $user->findByEmail($userConnectInfo);
        //CHECK IF PASSWORD MATCH
        if (password_verify($userConnectInfo->getPassword(), $connect->getPassword())) {
            var_dump('ok');
        //SET DES DONNEES DE SESSION
        } else {
            throw new \Exception("Wrong password");
        }
    }
}
