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
    private $message;

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
            $subject = 'Nouveau message de '.$securedData->firstname . $securedData->name;
            //mail content
            $template = $this->twig->load('home/mail.html.twig');
            $mailTwig = $template->render([
                'firstname' => stripcslashes($securedData->firstname),
                'name' => stripslashes($securedData->name),
                'message' => stripslashes($securedData->message),
                'email' => stripslashes($securedData->email)
            ]);

            $headers = array(
                'From' => 'debackre.guillaume@gmail.com',
                'Reply-To' => 'debackre.guillaume@gmail.com',
                'X-Mailer' => 'PHP/' . phpversion(),
                'Content-type' => 'text/html'
            );

            $oneUser = new UserRepository($this->getDBConnexion());
            $theUser = $oneUser->findById(1);

            if (mail($to, $subject, $mailTwig, $headers) === true && empty($this->checkErrors)) {
                $this->message = 'Votre mail a bien été envoyé';
                //DISPLAY TEMPLATE AND SEND VARIABLES
                $template = $this->twig->load('home/index.html.twig');
                echo $template->render([
                    'checkErrors' => $this->checkErrors,
                    'message' => $this->message,
                    'user' => $theUser
                ]);
            } else {
                $this->message = "Une erreur est survenue lors de l'envoie du mail !";
                //DISPLAY TEMPLATE AND SEND VARIABLES
                $template = $this->twig->load('home/index.html.twig');
                echo $template->render([
                    'checkErrors' => $this->checkErrors,
                    'message' => $this->message,
                    'user' => $theUser
                ]);
            }
        }
    }
}
