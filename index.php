<?php
require_once realpath("vendor/autoload.php");

use Exceptions\ControllerNotFoundException;
use App\Router\Router;
use App\Router\Controller\HomeController;
use App\Router\Controller\MyPutController;
use App\Router\Controller\BlogController;
use App\Router\Request;


$router = new Router(
    [
        "/^\/$/" => [
            'methods' => ['GET'],
            'controller' => new HomeController('viewPost')
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






