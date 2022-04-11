<?php
require_once realpath("vendor/autoload.php");

use App\Controllers\Blog\BlogController;
use App\Controllers\Blog\MyPutController;
use App\Controllers\Home\HomeController;
use App\Controllers\Home\SignUpController;
use App\Controllers\Home\UserController;
use App\Exceptions\ControllerNotFoundException;
use App\Repository\DBConnexion;
use App\Router\Router;
use App\Router\Request;

//Chemin vers la racine du projet
define('ROOT', dirname(__DIR__));

// Loading for .env at the root directory
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Router
$router = new Router(
    [
        "/^\/$/" => [
            'methods' => ['GET'],
            'controller' => new HomeController('blog')
        ],
        "/^\/user/" => [
            'methods' => ['GET'],
            'controller' => new UserController()
        ],
        "/^\inscription/$/" => [
            'methods' => ['POST'],
            'controller' => new SignUpController()
        ],
        "/^\/blog$/" => [
            'methods' => ['GET'],
            'controller' => new BlogController('blog')
        ],
        "/post\/\d+/" => [
            'methods' => ['POST', 'GET', 'PUT'],
            'controller' => new MyPutController('blog')
        ]
        /*
        "/^\/post\/\d+/" => [
            'methods' => ['POST', 'GET', 'PUT'],
            'controller' => new MyPutController('blog')
        ],*/
    ]
);

try {
    $url = $_GET['url'];
    $request = new Request('GET','/'.$url);
    $router->execute($request);
}catch (ControllerNotFoundException $e){
    echo $e;
}







