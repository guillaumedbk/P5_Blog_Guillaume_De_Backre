<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Entity\Comment\Comment;
use App\Entity\Post\Post;
use App\Entity\User\User;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Router\Request;
use DateTime;


class HomeController extends Controller
{

    public function __invoke(Request $request)
    {

        $oneUser = new UserRepository($this->getDBConnexion());
        $theUser = $oneUser->findById(1);

        $comment = new UserRepository($this->getDBConnexion());
        $newComment = new Comment('1', '2', 'Trop bien', new DateTime('now'), 'attente');
        $test = $comment->findById(1);

        //DISPLAY TEMPLATE AND SEND VARIABLES
        $template = $this->twig->load('home/index.html.twig');
        echo $template->render([
            'user' => $theUser
        ]);

       // var_dump($request->getMatches());
        var_dump($test);
    }
}