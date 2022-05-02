<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Entity\Comment\Comment;
use App\Repository\CommentRepository;
use App\Router\Request;

class CommentController extends Controller
{
    public function __invoke(Request $request): void
    {
        $comment = new CommentRepository($this->getDBConnexion());
        var_dump($request);
        //$getComment = $request->getComment();
        //$comment->createComment($getComment);
    }
}
