<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Entity\User\User;
use App\Repository\FileLogger;
use App\Repository\UserRepository;
use App\Router\Request;
use App\Router\Router;
use HttpRequest;

class SignUpController extends Controller
{
    public function __invoke(Request $request): void
    {
        if ($request->getMethod() === "GET") {
            $this->getSignUpController();
        } elseif ($request->getMethod() === "POST") {
            $user = $request->getUser();
            $this->postSignUpController($user);
        }
    }

    public function getSignUpController(): void
    {
        //DISPLAY TEMPLATE AND SEND VARIABLES
        $template = $this->twig->load('home/signUp.html.twig');
        echo $template->render();
    }

    public function postSignUpController($user): void
    {
        try {
            //CHECK DATA VALIDITY OF firstname and name
            $validation = array($user->getFirstname(), $user->getName());
            foreach ($validation as $value) {
                $this->validate($value);
            }
            //CHECK EMAIL VALIDITY
            $this->checkEmailValidity($user->getEmail());
            //CHECK STATUS VALIDITY
            $this->checkStatusValidity($user->getStatus());
            //INSERT NEW USER
            $userrepo = new UserRepository($this->getDBConnexion());
            $insert = $userrepo->createUser($user);
            header('Location: /P5_Blog_Guillaume_De_Backre/');
        } catch (\Exception $exception) {
            $logger = new FileLogger('logger.log');
            $logger->critical("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
            throw new \Exception("The following error has occured:  {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }
}
