<?php

namespace App\Router\Controller;

use App\Router\Request;

class BlogController
{
    public function __invoke(Request $request): string
    {
        $blog = require ('src/views/viewBlog.php');
        return $blog;
    }

}