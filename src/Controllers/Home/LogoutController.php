<?php

namespace App\Controllers\Home;

use App\Router\Request;

class LogoutController
{
    public function __invoke(Request $request): void
    {
        session_destroy();
        header('Location: /');
    }
}
