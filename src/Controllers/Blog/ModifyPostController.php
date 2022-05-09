<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Router\Request;

class ModifyPostController extends Controller
{
    public function __invoke(Request $request): void
    {
        if ($request->getMethod() === "GET") {
            $this->getModifyPostController();
        } elseif ($request->getMethod() === "POST") {
            $this->postModifyPostController($request);
        }
    }

    public function getModifyPostController(): void
    {
        //DISPLAY TEMPLATE
        $template = $this->twig->load('blog/modifyPost.html.twig');
        echo $template->render();
    }

    public function postModifyPostController($request): void
    {

    }
}