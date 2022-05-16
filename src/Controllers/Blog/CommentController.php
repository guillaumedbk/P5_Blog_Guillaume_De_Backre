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
        if ($request->getMethod() === "GET") {
            $this->getModifyStatusCommentController($request);
        } elseif ($request->getMethod() === "POST") {
            $this->postCommentController($request);
        }
    }

    public function getModifyStatusCommentController(Request $request)
    {
        $id = $request->getMatches()[1];
        $comment = new CommentRepository($this->getDBConnexion());
        $comment->changeStatus($id);
        header('Location: /P5_Blog_Guillaume_De_Backre/administration');
    }

    public function postCommentController(Request $request)
    {
        //ARRAY OF DATA + SECURE
        $security = new SecurePostData();
        $securedContent = $security->secureData($request->getData());

        //HYDRATE THE DTO
        $dto = $this->hydrateDto($securedContent, new CommentDTO());

        //CHECK CONTENT VALIDITY
        $validator = new Validator();
        $commentValidator = new CommentAssertMapValidator();
        $this->checkErrors = $validator->validate($commentValidator, $dto);

        //DATA
        $user = $request->getSession();
        $userId = $user['USER']->getId();
        $postId = $request->getMatches()[1];
        $comment = $securedContent['comment'];

        //NEW COMMENT OBJECT
        $date = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
        $data = new Comment($userId, $postId, $comment, $date, 'attente');

        //CREATE COMMENT
        if (empty($this->checkErrors)) {
            //INSERT NEW COMMENT
            $comment = new CommentRepository($this->getDBConnexion());
            $comment->createComment($data);
            header('Location: /P5_Blog_Guillaume_De_Backre/post/'.$postId);
        } else {
            //DISPLAY TEMPLATE AND SEND VARIABLES
            $template = $this->twig->load('error.html.twig');
            echo $template->render([
                'checkError' => $this->checkErrors
            ]);
        }
    }


}
