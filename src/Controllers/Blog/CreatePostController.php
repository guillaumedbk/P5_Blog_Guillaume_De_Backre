<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Entity\Post\PostDTO;
use App\Repository\PostRepository;
use App\Router\Request;
use App\Validator\Security\SecurePostData;
use App\Validator\Validators\PostAssertMapValidator;
use App\Validator\Validators\Validator;

class CreatePostController extends Controller
{
    private $checkErrors;

    public function __invoke(Request $request): void
    {
        if ($request->getMethod() === "GET") {
            $this->getCreatePostController();
        } elseif ($request->getMethod() === "POST") {
            $this->postCreatePostController($request);
        }
    }

    public function getCreatePostController(): void
    {
        $template = $this->twig->load('blog/createPost.html.twig');
        echo $template->render();
    }

    public function postCreatePostController($request): void
    {
        //RETRIEVE AND SECURE DATA
        $security = new SecurePostData();
        $securedData = $security->secureData($request->getData());
        $userId = $request->getSession()['USER']['userId'];
        $data = array("userId" => $userId, "title" => $securedData['title'], "chapo" => $securedData['chapo'], "content" => $securedData['content']);
        //HYDRATE THE DTO
        $dto = $this->hydrateDto($data, new PostDTO());
        //CHECK DATA VALIDITY
        $validator = new Validator();
        $postValidator = new PostAssertMapValidator();
        $this->checkErrors = $validator->validate($postValidator, $dto);
        //CREATE POST
        if (empty($this->checkErrors)){
            $postRepo = new PostRepository($this->getDBConnexion());
            $postRepo->createPost($dto);
            header('Location: /P5_Blog_Guillaume_De_Backre/blog');
        }else{
            //DISPLAY TEMPLATE AND SEND VARIABLES
            $template = $this->twig->load('error.html.twig');
            echo $template->render([
                'checkError' => $this->checkErrors
                ]);
        }
    }
}
