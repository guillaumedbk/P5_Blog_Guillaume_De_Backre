<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Router\Request;

class AdministrationController extends Controller
{
    private $checkError;

    public function __invoke(Request $request): void
    {
        if (!isset($_SESSION['LOGGED']) || !$_SESSION['LOGGED']) {
            header('Location: /P5_Blog_Guillaume_De_Backre/connexion');
        } elseif ($request->getSession()['USER']->getStatus() != 'admin') {
            $this->checkError['Autorisation'] = 'Vous n\'êtes pas autorisé à accéder à cette page';
            $template = $this->twig->load('error.html.twig');
            echo $template->render([
                'checkError' => $this->checkError
            ]);
        } else {
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
}
