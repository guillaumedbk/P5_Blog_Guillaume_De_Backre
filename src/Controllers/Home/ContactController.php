<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;
use App\Repository\UserRepository;
use App\Router\Request;
use App\Validator\Security\SecurePostData;
use App\Validator\Validators\ContactAssertMapValidator;
use App\Validator\Validators\Validator;

class ContactController extends Controller
{
    private $checkErrors;

    public function __invoke(Request $request): void
    {
        if (!empty($request->getData())) {
            //retrieve data in a secure way
            $security = new SecurePostData();
            $securedData = $security->secureData($request->getData());
            //data validation
            $repo = new UserRepository($this->getDBConnexion());
            //array to object
            $securedData = $repo->hydrate($securedData);
            $validator = new Validator();
            $contactValidator = new ContactAssertMapValidator();
            $this->checkErrors = $validator->validate($contactValidator, $securedData);

            //send email
            $to = 'debackre.guillaume@gmail.com';
            $subject = 'the subject';
            $message = $securedData->message;
            $headers = array(
                'From' => 'debackre.guillaume@gmail.com',
                'Reply-To' => 'debackre.guillaume@gmail.com',
                'X-Mailer' => 'PHP/' . phpversion()
            );
            if(mail($to, $subject, $message, $headers) === true){
                echo  'votre mail a bien été envoyé';
            }else{
                 echo "une erreur est survenue lors de l'envoie du mail";
            }
        }
    }
}
