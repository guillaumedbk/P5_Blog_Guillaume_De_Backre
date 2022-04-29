<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Controllers\Validator;
use App\Entity\User\User;
use App\Repository\FileLogger;
use App\Repository\UserRepository;
use App\Router\Request;
use App\Router\Router;

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
            $validator = new Validator($user);
            //CHECK DATA VALIDITY OF firstname and name
            $validation = array($user->getFirstname(), $user->getName());
            foreach ($validation as $value) {
                $validator->validate($value);
            }
            //CHECK EMAIL VALIDITY
            $validator->checkEmailValidity($user->getEmail());
            //CHECK STATUS VALIDITY
            $validator->checkStatusValidity($user->getStatus());
            //CHECK MAIL UNIQUENESS
            $userrepo = new UserRepository($this->getDBConnexion());
            if ($userrepo->mailUniquess($user->getEmail()) === true) {
                throw new \Exception("Mail already exist in bdd");
            } else {
                //INSERT NEW USER
                $userrepo->createUser($user);
                //SET DATA SESSION
                $_SESSION['LOGGED'] = true;
                $_SESSION['FIRSTNAME'] = $user->getFirstName();
                $_SESSION['NAME'] = $user->getName();
                $_SESSION['STATUS'] = $user->getStatus();
                $_SESSION['TOKEN'] = md5(time()*rand(153, 728));
                header('Location: /P5_Blog_Guillaume_De_Backre/');
            }
        } catch (\Exception $exception) {
            $logger = new FileLogger('logger.log');
            $logger->critical("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
            throw new \Exception("The following error has occured:  {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }
}
