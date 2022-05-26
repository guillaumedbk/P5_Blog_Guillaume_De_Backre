<?php
namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Entity\User\User;
use App\Entity\User\UserSignUpDTO;
use App\Repository\UserRepository;
use App\Router\Request;
use App\Validator\Security\SecurePostData;
use App\Validator\Validators\ModifyUserAssertMapValidator;
use App\Validator\Validators\SignUpAssertMapValidator;
use App\Validator\Validators\Validator;

class ModifyUserController extends Controller
{
    private $checkErrors;

    public function __invoke(Request $request): void
    {
        if ($request->getMethod() === "GET") {
            $this->getModifyUserController($request);
        } elseif ($request->getMethod() === "POST") {
            $this->postModifyUserController($request);
        }
    }

    public function getModifyUserController(Request $request)
    {
        $user = new UserRepository($this->getDBConnexion());
        $id = $request->getMatches()[1];
        $user = $user->findById($id);
        $session = $request->getSession();
        //DISPLAY TEMPLATE
        $template = $this->twig->load('blog/modifyUser.html.twig');
        echo $template->render([
            'session' => $session,
            'user' => $user
        ]);
    }

    public function postModifyUserController(Request $request)
    {
        //RETRIEVE AND SECURE DATA
        $security = new SecurePostData();
        $securedData = $security->secureData($request->getData());
        //HYDRATE THE DTO
        $dto = $this->hydrateDto($securedData, new UserSignUpDTO());
        //CHECK DATA VALIDITY
        $validator = new Validator();
        $userValidator = new ModifyUserAssertMapValidator();
        $this->checkErrors = $validator->validate($userValidator, $dto);
        $userId = $request->getMatches()[1];

        if (empty($this->checkErrors)) {
            //MODIFY USER
            $userRepo = new UserRepository($this->getDBConnexion());
            $user = new User($userId, $dto->firstname, $dto->name, $dto->email, $dto->status, $dto->bio, $dto->password);
            $userRepo->modifyUser($user, $userId);
            header('Location: /administration');
        }else {
            //DISPLAY TEMPLATE AND SEND VARIABLES
            $template = $this->twig->load('blog/modifyUser.html.twig');
            echo $template->render([
                'checkErrors' => $this->checkErrors,
                'session' => $request->getSession(),
                'user' => $dto
            ]);
        }
    }
}
