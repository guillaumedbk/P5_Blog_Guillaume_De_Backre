<?php

require_once realpath("vendor/autoload.php");

use App\Controllers\Blog\BlogController;
use App\Controllers\Blog\CommentController;
use App\Controllers\Blog\CreatePostController;
use App\Controllers\Blog\ModifyPostController;
use App\Controllers\Blog\PostController;
use App\Controllers\Home\HomeController;
use App\Controllers\Home\LoginController;
use App\Controllers\Home\LogoutController;
use App\Controllers\Home\SignUpController;
use App\Controllers\Home\UserController;
use App\Entity\Comment\Comment;
use App\Entity\User\User;
use App\Entity\User\UserConnectInfo;
use App\Exceptions\ControllerNotFoundException;
use App\Repository\DBConnexion;
use App\Repository\UserSession;
use App\Router\Request;
use App\Router\Router;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
            'methods' => ['GET'],
            'controller' => new PostController()
        ],
        "/^\/post\/(\d+)$/" => [
            'methods' => ['DELETE'],
            'controller' => new PostDeleteController()
        ],
        "/^\/post\/create$/" => [
            'methods' => ['GET', 'POST'],
            'controller' => new CreatePostController()
        ],
        "/^\/post\/update\/(\d+)$/" => [
            'methods' => ['GET', 'POST'],
            'controller' => new ModifyPostController()
        ],
        "/^\/comment\/(\d+)$/" => [
            'methods' => ['POST'],
            'controller' => new CommentController()
        ]
    ]
);

try {
    $url = $_GET['url'];
    $request = new Request($_SERVER['REQUEST_METHOD'], '/'.$url, $_SESSION, $_POST, $_GET);
    $router->execute($request);
} catch (ControllerNotFoundException $e) {
    echo $e;
}
