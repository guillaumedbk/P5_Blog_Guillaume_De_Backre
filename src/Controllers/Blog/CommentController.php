<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Entity\Comment\Comment;
use App\Entity\Comment\CommentDTO;
use App\Repository\CommentRepository;
use App\Router\Request;
use App\Validator\Security\SecurePostData;
use App\Validator\Validators\CommentAssertMapValidator;
use App\Validator\Validators\UserAssertMapValidator;
use App\Validator\Validators\Validator;

class CommentController extends Controller
{
    private $checkErrors;

    public function __invoke(Request $request): void
    {
        //DATA
        $user = $request->getSession();
        $userId = $user['USER']['userId'];
        $postId = $request->getMatches()[1];
        $content = $request->getData()['comment'];
        //ARRAY OF DATA + SECURE
        $data = array("userId" => $userId, "postId" => $postId, "comment" => $content);
        $security = new SecurePostData();
        $securedData = $security->secureData($data);
        //HYDRATE THE DTO
        $dto = $this->hydrateDto($securedData, new CommentDTO());
        //CHECK DATA VALIDITY
        $validator = new Validator();
        $commentValidator = new CommentAssertMapValidator();
        $this->checkErrors = $validator->validate($commentValidator, $dto);
        //CREATE COMMENT
        if(empty($this->checkErrors)){
            $comment = new CommentRepository($this->getDBConnexion());
            $comment->createComment($dto);
            header('Location: /P5_Blog_Guillaume_De_Backre/post/'.$postId);
        }else{
            //DISPLAY TEMPLATE AND SEND VARIABLES
            $template = $this->twig->load('error.html.twig');
            echo $template->render([
                'checkError' => $this->checkErrors
            ]);
        }

        //$getComment = $request->getComment();
        //$comment->createComment($getComment);
    }
}
