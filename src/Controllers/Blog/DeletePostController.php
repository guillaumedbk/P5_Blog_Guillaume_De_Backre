<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Repository\PostRepository;
use App\Router\Request;

class DeletePostController extends Controller
{
    private $checkErrors;

    public function __invoke(Request $request): void
    {
        $postId = $request->getMatches()[1];
        $connectedUser = $request->getSession()['USER']->getId();
        $postRepo = new PostRepository($this->getDBConnexion());
        $post = $postRepo->findById($postId);
        $postAuthor = $post->getUserId();
        //CHECK PERMISSION TO DELETE
        if ($postAuthor === $connectedUser){
            $postRepo->deleteById($postId);
            header('Location: /blog');
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