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
    $request = new Request($_SERVER['REQUEST_METHOD'], '/'.$url);
    //SIGNUP USER DATA
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $request->getPath() == '/inscription') {
        $request->setUser(new User(strip_tags($_POST['firstname']), strip_tags($_POST['name']), strip_tags($_POST['email']), 'admin', strip_tags($_POST['bio']), strip_tags(password_hash($_POST['password'], PASSWORD_DEFAULT))));
    }
    //CONNECT USER DATA
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $request->getPath() == '/connexion') {
        $request->setUserConnectInfos(new UserConnectInfo(strip_tags($_POST['email']), strip_tags($_POST['password']), strip_tags($_SESSION['TOKEN'])));
    }
    //USER SESSION
    if (isset($_SESSION['LOGGED'],$_SESSION['FIRSTNAME'],$_SESSION['NAME'],$_SESSION['STATUS'])) {
        $request->setSession(array("logged" => $_SESSION['LOGGED'], "firstname" => $_SESSION['FIRSTNAME'], "name" => $_SESSION['NAME'], "status" => $_SESSION['STATUS'], "token" => $_SESSION['TOKEN']));
    }
    $router->execute($request);
} catch (ControllerNotFoundException $e) {
    echo $e;
}
