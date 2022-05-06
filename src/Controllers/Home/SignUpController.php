<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Controllers\Validator;
use App\Entity\User\User;
use App\Entity\User\UserSignUpDTO;
use App\Repository\FileLogger;
use App\Repository\UserRepository;
use App\Repository\UserSession;
use App\Router\Request;
use App\Router\Router;
use App\Validator\Security\SecurePostData;
use App\Validator\Validators\UserAssertMapValidator;

class SignUpController extends Controller
{
    private $checkErrors;

    public function __invoke(Request $request): void
    {
        if ($request->getMethod() === "GET") {
            $this->getSignUpController();
        } elseif ($request->getMethod() === "POST") {
            $this->postSignUpController($request);
        }
    }

    public function getSignUpController(): void
    {
        //DISPLAY TEMPLATE AND SEND VARIABLES
        $template = $this->twig->load('home/signUp.html.twig');
        echo $template->render();
    }

    public function postSignUpController(Request $request): void
    {
        try {
            //RETRIEVE AND SECURE DATA
            $security = new SecurePostData();
            $securedData = $security->secureData($request->getData());
            //HYDRATE THE DTO
            $dto = $this->hydrateSignDto($securedData, new UserSignUpDTO());
            //CHECK DATA VALIDITY
            $validator = new \App\Validator\Validators\Validator();
            $userValidator = new UserAssertMapValidator();
            $this->checkErrors = $validator->validate($userValidator, $dto);
            //CHECK MAIL UNIQUENESS
            $userRepo = new UserRepository($this->getDBConnexion());
            if ($userRepo->mailUniquess($dto->email) === true) {
                $this->checkErrors['email'] = ['Mail already exist in bdd'];
                throw new \Exception("Mail already exist in bdd");
            } else {
                //INSERT NEW USER
                $userRepo->createUser($dto);
                //NEW SESSION
                $session = new UserSession();
                $userInfo = array(
                    'firstname' => $dto->firstname,
                    'name' => $dto->name,
                    'bio' => $dto->bio,
                    'status' =>$dto->status
                );
                $session->addSessionKey('USER', $userInfo);
                header('Location: /P5_Blog_Guillaume_De_Backre/');
            }
            if (!empty($this->checkErrors)) {
                //DISPLAY TEMPLATE AND SEND VARIABLES
                $template = $this->twig->load('error.html.twig');
                echo $template->render([
                'checkError' => $this->checkErrors
            ]);
            }
        } catch (\Exception $exception) {
            $logger = new FileLogger('logger.log');
            $logger->critical("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
            throw new \Exception("The following error has occured:  {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }
}
