<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Entity\User\User;
use App\Entity\User\UserConnectInfo;
use App\Entity\User\UserLoginDTO;
use App\Entity\User\UserSession;
use App\Repository\UserRepository;
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
        $dto = $this->hydrateLoginDto($securedData, new UserLoginDTO());
        //CHECK DATA VALIDITY
        $validator = new Validator();
        $userValidator = new UserAssertMapValidator();
        $this->checkErrors = $validator->validate($userValidator, $dto);

        //CHECK IF DATA MATCHES
        $userRepo = new UserRepository($this->getDBConnexion());
        $user = $userRepo->findByEmail($dto->email);

        //CHECK IF PASSWORD MATCH
        if ($user !== NULL && password_verify($dto->password, $user->getPassword())) {
            //NEW SESSION
            new UserSession($user);
            header('Location: /P5_Blog_Guillaume_De_Backre/');
        } else {
            $this->checkErrors['error'] = ['Wrong email or password'];
            var_dump($this->checkErrors);
            //DISPLAY TEMPLATE AND SEND VARIABLES
            $template = $this->twig->load('home/login.html.twig');
            echo $template->render([
                'checkErrors' => $this->checkErrors,
                'dto'=>$dto
            ]);
        }
    }
}
