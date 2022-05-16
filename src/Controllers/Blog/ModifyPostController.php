<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Entity\Post\PostDTO;
use App\Repository\PostRepository;
use App\Router\Request;
use App\Validator\Security\SecurePostData;
use App\Validator\Validators\PostAssertMapValidator;
use App\Validator\Validators\Validator;

class ModifyPostController extends Controller
{
    public function __invoke(Request $request): void
    {
        if ($request->getMethod() === "GET") {
            $this->getModifyPostController($request);
        } elseif ($request->getMethod() === "POST") {
            $this->postModifyPostController($request);
        }
    }

    public function getModifyPostController($request): void
    {
        $postId = $request->getMatches()[1];
        $postRepo = new PostRepository($this->getDBConnexion());
        $post = $postRepo->findById($postId);
        //DISPLAY TEMPLATE
        $template = $this->twig->load('blog/modifyPost.html.twig');
        echo $template->render([
            'postId' => $postId,
            'post' => $post
        ]);
    }

    public function postModifyPostController($request): void
    {
        //RETRIEVE AND SECURE DATA
        $security = new SecurePostData();
        $securedData = $security->secureData($request->getData());
        $userId = $request->getSession()['USER']->getId();
        $data = array("userId" => $userId, "title" => $securedData['title'], "chapo" => $securedData['chapo'], "content" => $securedData['content']);
        //HYDRATE THE DTO
        $dto = $this->hydrateDto($data, new PostDTO());
        //CHECK DATA VALIDITY
        $validator = new Validator();
        $postValidator = new PostAssertMapValidator();
        $this->checkErrors = $validator->validate($postValidator, $dto);
        //GET THE POST IN QUESTION
        $postRepo = new PostRepository($this->getDBConnexion());
        $postId = $request->getMatches()[1];
        $post = $postRepo->findById($postId);
        //CHECK IF USER WHO WHANTS TO MODIFY POST IS THE WHO CREATED IT
        if ($userId === $post->getUserId() && empty($this->checkErrors)){
            $postRepo->modifyPost($dto, $postId);
            header('Location: /P5_Blog_Guillaume_De_Backre/blog');
        }else{
            $this->checkErrors['Permission'] = ['You\'re not allowed to modify this post'];
            //DISPLAY TEMPLATE AND SEND VARIABLES
            $template = $this->twig->load('error.html.twig');
            echo $template->render([
                'checkError' => $this->checkErrors
            ]);
        }
    }
}