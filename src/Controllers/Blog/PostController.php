<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Repository\CommentRepository;
use App\Repository\DBConnexion;
use App\Repository\PostRepository;
use App\Router\Request;
use Twig\Extension\AbstractExtension;

class PostController extends Controller
{

    public function __invoke(Request $request): void
    {
        $onePost = new PostRepository($this->getDBConnexion());
        $comment = new CommentRepository($this->getDBConnexion());
        $requestMatches = $request->getMatches();
        $id =$requestMatches[1];

        $post = $onePost->findById($id);
        $comments = $comment->getOnePostComments($id);

        //DISPLAY TEMPLATE
        $template = $this->twig->load('blog/post.html.twig');

        //USER'S SESSION
        $userSession = $request->getSession();

        //SEND VARIABLES
        echo $template->render([
            'session' => $userSession,
            'postId' => $id,
            'post' => $post,
            'comments' => $comments
        ]);
    }
}
