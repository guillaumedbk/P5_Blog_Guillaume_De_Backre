<?php

namespace App\Router\Controller;

use App\Router\Request;

class HomeController
{
    private string $titi;

    public function __construct(string $titi)
    {
        $this->titi = $titi;
    }

    public function __invoke(Request $request): string
    {
        $response = require('src/views/viewHomePage.php');
        return $response;
    }
}