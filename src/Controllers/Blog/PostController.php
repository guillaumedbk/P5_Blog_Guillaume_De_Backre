<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Repository\DBConnexion;
use App\Repository\PostRepository;
use App\Router\Request;
use Twig\Extension\AbstractExtension;

class PostController extends Controller
{
    public function __invoke(Request $request): void
    {
        $onePost = new PostRepository($this->getDBConnexion());
        $requestMatches = $request->getMatches();
        $id =$requestMatches[1];

        $post = $onePost->findById($id);

        //DISPLAY TEMPLATE
        $template = $this->twig->load('blog/post.html.twig');

        //SEND VARIABLES
        echo $template->render([
            'post' => $post,
        ]);
    }
}
