<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Entity\User\UserConnectInfo;
use App\Entity\User\UserLoginDTO;
use App\Repository\UserRepository;
use App\Repository\UserSession;
use App\Router\Request;
use App\Validator\Security\SecurePostData;
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
        //RETRIEVE AND SECURE DATA
        $security = new SecurePostData();
        $securedData = $security->secureData($request->getData());
        //HYDRATE THE DTO
        $dto = $this->hydrate($securedData, new UserLoginDTO());
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
            $session = new UserSession();
            $userInfo = array(
                'firstname' => $connect->getFirstname(),
                'name' => $connect->getName(),
                'status' =>$connect->getStatus()
            );
            $session->addSessionKey('USER', $userInfo);
            header('Location: /P5_Blog_Guillaume_De_Backre/');
        } else {
            //DISPLAY TEMPLATE AND SEND VARIABLES
            $template = $this->twig->load('error.html.twig');
            echo $template->render([
                'checkError' => $this->checkErrors
            ]);
        }
    }
}
