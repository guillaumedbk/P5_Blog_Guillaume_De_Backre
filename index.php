<?php

require_once realpath("vendor/autoload.php");

use App\Controllers\Blog\BlogController;
use App\Controllers\Blog\MyPutController;
use App\Controllers\Home\HomeController;
use App\Controllers\Home\LoginController;
use App\Controllers\Home\LogoutController;
use App\Controllers\Home\SignUpController;
use App\Controllers\Home\UserController;
use App\Entity\User\User;
use App\Entity\User\UserConnectInfo;
use App\Exceptions\ControllerNotFoundException;
use App\Repository\DBConnexion;
use App\Router\Request;
use App\Router\Router;

//Chemin vers la racine du projet
\define('ROOT', \dirname(__DIR__));

// Loading for .env at the root directory
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Router
$router = new Router(
    [
        "/^\/$/" => [
            'methods' => ['GET'],
            'controller' => new HomeController()
        ],
        "/^\/user$/" => [
            'methods' => ['GET'],
            'controller' => new UserController()
        ],
        "/^\/inscription$/" => [
            'methods' => ['GET', 'POST'],
            'controller' => new SignUpController()
        ],
        "/^\/disconnect/" => [
            'methods' => ['GET'],
            'controller' => new LogoutController()
        ],
        "/^\/connexion$/" => [
            'methods' => ['GET', 'POST'],
            'controller' => new LoginController()
        ],
        "/^\/blog$/" => [
            'methods' => ['GET'],
            'controller' => new BlogController()
        ],
        "/^\/post\/(\d+)$/" => [
            'methods' => ['POST', 'GET', 'PUT'],
            'controller' => new MyPutController()
        ]
    ]
);

try {
    $url = $_GET['url'];
    $request = new Request($_SERVER['REQUEST_METHOD'], '/'.$url, $_GET, $_POST);
    $router->execute($request);
} catch (ControllerNotFoundException $e) {
    echo $e;
}
