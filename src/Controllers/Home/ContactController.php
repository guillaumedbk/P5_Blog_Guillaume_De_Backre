<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Router\Request;

class ContactController extends Controller
{
    public function __invoke(Request $request): void
    {
        var_dump($request->getData());
    }
}