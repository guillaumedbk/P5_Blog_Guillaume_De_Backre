<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Router\Request;

class AdministrationController extends Controller
{
    public function __invoke(Request $request): void
    {
        $session = $request->getSession();
        $comment = new CommentRepository($this->getDBConnexion());
        $comments = $comment->all();
        $post = new PostRepository($this->getDBConnexion());
        $posts = $post->all();
        $user = new UserRepository($this->getDBConnexion());
        $users = $user->all();

        $template = $this->twig->load('blog/administration.html.twig');
        echo $template->render([
            'session' => $session,
            'comments' => $comments,
            'posts' => $posts,
            'users' => $users
        ]);
    }
}