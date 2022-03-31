<?php

namespace App\Repository\home;

use App\Repository\Controller;
use App\Router\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        return $this->twig->display('home/index.html.twig');
    }
}