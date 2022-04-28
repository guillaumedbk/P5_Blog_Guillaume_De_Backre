<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Repository\DBConnexion;
use App\Repository\PostRepository;
use App\Router\Request;
use Twig\Extension\AbstractExtension;

class BlogController extends Controller
{
    public function __invoke(Request $request): void
    {
        if (!isset($_SESSION['LOGGED']) || !$_SESSION['LOGGED']) {
            header('Location: /P5_Blog_Guillaume_De_Backre/connexion');
        } else {
            $template = $this->twig->load('blog/index.html.twig');
            $blog = new PostRepository($this->getDBConnexion());
            $allPosts = $blog->all();
            echo $template->render([
                'session' => $request->getSession(),
                'posts' => $allPosts
            ]);
        }
    }
}
