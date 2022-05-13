<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Entity\User\User;
use App\Entity\User\UserSession;
use App\Entity\User\UserSignUpDTO;
use App\Repository\FileLogger;
use App\Repository\UserRepository;
use App\Router\Request;
use App\Validator\Security\SecurePostData;
use App\Validator\Validators\SignUpAssertMapValidator;
use App\Validator\Validators\Validator;

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
        echo $template->render([
            'checkErrors' => $this->checkErrors
        ]);
    }

    public function postSignUpController(Request $request): void
    {
        try {
            //RETRIEVE AND SECURE DATA
            $security = new SecurePostData();
            $securedData = $security->secureData($request->getData());
            //HYDRATE THE DTO
            $dto = $this->hydrateDto($securedData, new UserSignUpDTO());
            //CHECK DATA VALIDITY
            $validator = new Validator();
            $userValidator = new SignUpAssertMapValidator();
            $this->checkErrors = $validator->validate($userValidator, $dto);
            if (empty($this->checkErrors)) {
                //INSERT NEW USER
                $userRepo = new UserRepository($this->getDBConnexion());
                $user = new User(null, $dto->firstname, $dto->name, $dto->email, $dto->status, $dto->bio, $dto->password);
                $userRepo->createUser($user);
                //GET ID
                $id = $userRepo->getId($user->getEmail());
                //NEW SESSION
                $user->setId($id['id']);
                new UserSession($user);
                header('Location: /P5_Blog_Guillaume_De_Backre/');
            } else {
                //DISPLAY TEMPLATE AND SEND VARIABLES
                $template = $this->twig->load('home/signUp.html.twig');
                echo $template->render([
                'checkErrors' => $this->checkErrors,
                    'dto'=>$dto
            ]);
            }
        } catch (\Exception $exception) {
            $logger = new FileLogger('logger.log');
            $logger->critical("The following error has occured: {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
            throw new \Exception("The following error has occured:  {$exception->getMessage()} at line: {$exception->getLine()} in file {$exception->getFile()}");
        }
    }

    //OVERLOAD HYDRATE DTO
    protected function hydrateDto(array $donnees, $dto): object
    {
        parent::hydrateDto($donnees, $dto);

        foreach ($donnees as $key => $value) {
            $dto->$key = $value;
            //HASH THE PASSWORD
            if ($key === 'password') {
                $dto->$key = password_hash($value, PASSWORD_DEFAULT);
            }
        }
        return $dto;
    }
}
