<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Entity\Post\Post;
use App\Entity\User\User;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Router\Request;


class HomeController extends Controller
{

    public function __invoke(Request $request)
    {
        $oneUser = new UserRepository($this->getDBConnexion());
        $theUser = $oneUser->findById(1);

        $post = new PostRepository($this->getDBConnexion());
        $newPost = new Post('1', 'titre', 'trehio', 'ftyfu');
        $test = $post->createPost($newPost);

        //DISPLAY TEMPLATE AND SEND VARIABLES
        $template = $this->twig->load('home/index.html.twig');
        echo $template->render([
            'user' => $theUser
        ]);

       // var_dump($request->getMatches());
        var_dump($test);
    }
}