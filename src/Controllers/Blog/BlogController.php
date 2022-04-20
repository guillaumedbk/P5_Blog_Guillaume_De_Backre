<?php

namespace App\Controllers\Blog;

use App\Controllers\Controller;
use App\Repository\DBConnexion;
use App\Router\Request;
use Twig\Extension\AbstractExtension;

class BlogController extends Controller
{
    public function __invoke(Request $request)
    {
        $template = $this->twig->load('blog/index.html.twig');
        echo $template->render([
            'firstname' => 'John',
        ]);
    }
}
