<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Entity\User\User;
use App\Repository\FileLogger;
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
        $user = new User($_POST['firstname'], $_POST['name'], $_POST['email'], 'visitor', $_POST['bio'], $_POST['password']);
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
        } catch (\Exception $exception) {
            $logger = new FileLogger('logger.log');
            $logger->critical("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
            throw new \Exception("The following error has occured:  {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }
}
