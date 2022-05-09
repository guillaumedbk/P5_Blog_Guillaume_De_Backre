<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Router\Request;

class CreatePostController extends Controller
{
    public function __invoke(Request $request): void
    {
        if ($request->getMethod() === "GET") {
            $this->getCreatePostController();
        } elseif ($request->getMethod() === "POST") {
            $this->postCreatePostController($request);
        }
    }

    public function getCreatePostController(): void
    {
        $template = $this->twig->load('blog/createPost.html.twig');
        echo $template->render();
    }
}