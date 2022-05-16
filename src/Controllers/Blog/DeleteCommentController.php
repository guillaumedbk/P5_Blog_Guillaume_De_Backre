<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Router\Request;

class DeleteCommentController extends Controller
{
    private $checkErrors;

    public function __invoke(Request $request): void
    {
        $commentId = $request->getMatches()[1];
        $connectedUser = $request->getSession()['USER']->getId();
        $userStatus = $request->getSession()['USER']->getStatus();
        $commentRepo = new CommentRepository($this->getDBConnexion());
        $comment = $commentRepo->findById($commentId);
        $commentAuthor = $comment->getUserId();
        //CHECK PERMISSION TO DELETE
        if ($commentAuthor === $connectedUser || $userStatus === 'admin'){
            $commentRepo->deleteById($commentId);
            header('Location: /P5_Blog_Guillaume_De_Backre/administration');
        }else{
            $this->checkErrors['Permission'] = ['You\'re not allowed to modify this comment'];
            //DISPLAY TEMPLATE AND SEND VARIABLES
            $template = $this->twig->load('error.html.twig');
            echo $template->render([
                'checkError' => $this->checkErrors
            ]);
        }
    }
}