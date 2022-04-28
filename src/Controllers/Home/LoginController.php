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
            //SET DES DONNEES DE SESSION
            $_SESSION['LOGGED'] = true;
            $_SESSION['FIRSTNAME'] = $connect->getFirstName();
            $_SESSION['NAME'] = $connect->getName();
            $_SESSION['STATUS'] = $connect->getStatus();
            header('Location: /P5_Blog_Guillaume_De_Backre/');
        } else {
            throw new \Exception("Wrong password");
        }
    }
}
