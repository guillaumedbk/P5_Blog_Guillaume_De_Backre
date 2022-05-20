<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Router\Request;
use App\Validator\Security\SecurePostData;

class ContactController extends Controller
{
    public function __invoke(Request $request): void
    {
        if (!empty($request->getData())) {
            $security = new SecurePostData();
            $securedData = $security->secureData($request->getData());

            $to = 'debackre.guillaume@gmail.com';
            $subject = 'the subject';
            $message = $securedData['message'];
            $headers = array(
                'From' => 'debackre.guillaume@gmail.com',
                'Reply-To' => 'debackre.guillaume@gmail.com',
                'X-Mailer' => 'PHP/' . phpversion()
            );
            var_dump(mail($to, $subject, $message, $headers));
        }
    }
}
