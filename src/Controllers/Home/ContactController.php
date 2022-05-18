<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Router\Request;

class ContactController extends Controller
{
    public function __invoke(Request $request): void
    {
        if (!empty($request->getData())) {
            $to = 'debackre.guillaume@gmail.com';
            $subject = 'the subject';
            $message = 'hello';
            $headers = array(
                'From' => 'webmaster@example.com',
                'Reply-To' => 'webmaster@example.com',
                'X-Mailer' => 'PHP/' . phpversion()
            );
            var_dump(mail($to, $subject, $message, $headers));
        }
    }
}