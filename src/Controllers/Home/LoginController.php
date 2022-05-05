<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Entity\User\UserConnectInfo;
use App\Entity\User\UserLoginDTO;
use App\Repository\UserRepository;
use App\Router\Request;
use App\Validator\Validators\Validator;
use App\Validator\Validators\UserAssertMapValidator;

class LoginController extends Controller
{
    private $checkErrors;

    public function __invoke(Request $request): void
    {
        if ($request->getMethod() === "GET") {
            $this->getLoginController();
        } elseif ($request->getMethod() === "POST") {
            $this->postLoginController($request);
        }
    }

    public function getLoginController(): void
    {
        //DISPLAY TEMPLATE AND SEND VARIABLES
        $template = $this->twig->load('home/login.html.twig');
        echo $template->render();
    }

    public function postLoginController(Request $request): void
    {
        //RETRIEVE DATA
        $userConnectData = $request->getData();
        //HYDRATE THE DTO
        $dto = $this->hydrate($userConnectData, new UserLoginDTO());
        //CHECK DATA VALIDITY
        $validator = new Validator();
        $userValidator = new UserAssertMapValidator();
        $this->checkErrors = $validator->validate($userValidator, $dto);

        //CHECK IF DATA MATCHES
        $user = new UserRepository($this->getDBConnexion());
        $connect = $user->findByEmail($dto);

        //CHECK IF PASSWORD MATCH
        if (password_verify($dto->password, $connect->getPassword())) {
            //NEW SESSION
            var_dump('connecté');
            /*
            //SET DES DONNEES DE SESSION
            $_SESSION['LOGGED'] = true;
            $_SESSION['FIRSTNAME'] = $connect->getFirstName();
            $_SESSION['NAME'] = $connect->getName();
            $_SESSION['STATUS'] = $connect->getStatus();
            $_SESSION['TOKEN'] = md5(time()*rand(153, 728));
            header('Location: /P5_Blog_Guillaume_De_Backre/');
            */
        } else {
            //DISPLAY TEMPLATE AND SEND VARIABLES
            $template = $this->twig->load('error.html.twig');
            echo $template->render([
                'checkError' => $this->checkErrors
            ]);
        }
    }
}
