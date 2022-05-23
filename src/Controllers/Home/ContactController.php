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
            $subject = 'the subject';
            $mailContent = '
                    <html>
                    
                        <body>
                    
                            <div align="center">
                              <p>Prénom : '.$securedData->firstname.'</p>  <br />
                              <p>Nom : '.$securedData->name.' </p> <br />
                              <p>Message :</p> <br />'.nl2br($securedData->message).' </p> <br />
                              <p>Email :  '.$securedData->email.'  <br />
                    
                            </div>
                    
                        </body>
                    
                    </html>
                    ';

            $headers = array(
                'From' => 'debackre.guillaume@gmail.com',
                'Reply-To' => 'debackre.guillaume@gmail.com',
                'X-Mailer' => 'PHP/' . phpversion()
            );

            $oneUser = new UserRepository($this->getDBConnexion());
            $theUser = $oneUser->findById(1);

            if (mail($to, $subject, $mailContent, $headers) === true && empty($this->checkErrors)) {
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
