<?php

namespace App\Repository\blog;

use App\Router\Request;

class MyPutController
{
    public function __invoke(Request $request): string
    {
        $post = require('src/views/viewPost.php');
        return $post;
    }
}