<?php
require_once realpath("vendor/autoload.php");

use Exceptions\ControllerNotFoundException;
use App\Router\Router;
use App\Repository\home\HomeController;
use App\Repository\blog\MyPutController;
use App\Repository\blog\BlogController;
use App\Router\Request;

//Chemin vers la racine du projet
define('ROOT', dirname(__DIR__));

//Router
$router = new Router(
    [
        "/^\/$/" => [
            'methods' => ['GET'],
            'controller' => new HomeController()
        ],
        "/^\/blog$/" => [
            'methods' => ['GET'],
            'controller' => new BlogController()
        ],
        "/^\/post\/\d+$/" => [
            'methods' => ['POST', 'GET', 'PUT'],
            'controller' => new MyPutController()
        ],
    ]
);

$url = $_GET['url'];
$request = new Request('GET','/'.$url);
echo $router->execute($request);






