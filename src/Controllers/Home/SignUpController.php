<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Entity\User\User;
use App\Repository\UserRepository;
use App\Router\Request;

class SignUpController extends Controller
{
    public function __invoke(Request $request): void
    {
        if ($request->getMethod() === "GET") {
            $this->getSignUpController();
        } elseif ($request->getMethod() === "POST") {
            $this->postSignUpController();
        }
    }

    public function getSignUpController(): void
    {
        //DISPLAY TEMPLATE AND SEND VARIABLES
        $template = $this->twig->load('home/signUp.html.twig');
        echo $template->render();
    }

    public function postSignUpController(): void
    {
        //$user = new User($_POST['firstname'], $_POST['name'], $_POST['email'], 'utilisateur', $_POST['bio'], $_POST['password']);
        // $userrepo = new UserRepository($this->getDBConnexion());
        //  $insert = $userrepo->createUser($user);
        echo 'User creation';
    }
}
