<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Entity\Comment\Comment;
use App\Entity\Post\Post;
use App\Entity\User\User;
use App\Exceptions\CustomException;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Router\Request;
use DateTime;

class HomeController extends Controller
{
    public function __invoke(Request $request): void
    {
        $oneUser = new UserRepository($this->getDBConnexion());
        $theUser = $oneUser->findById(1);

        //DISPLAY TEMPLATE AND SEND VARIABLES
        $template = $this->twig->load('home/index.html.twig');
        echo $template->render([
            'user' => $theUser,
            'session' => $request->getSession()
        ]);
        // var_dump($request->getMatches());
    }
}
