<?php

class Router
{
    //attributes
    private $_ctrl;
    private $_view;

    //router management
    public function routeReq()
    {
        try
        {
            //automatic loading of the class
            spl_autoload_register(function($class){
                require_once ('Model/'.$class.'.php');
            });
            $url = '';

            //controller is included depending on the user's action
            if(isset($_GET['url']))
            {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));

                $controller = ucfirst(strtolower($url[0]));
                $controllerClass = "Controller".$controller;
                $controllerFile = "Controller/".$controllerClass.".php";

                if(file_exists($controllerFile))
                {
                    require_once ($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                }
                else
                {
                    throw new Exception('Page cannot be found');
                }
            }else
            {
                require_once ('Controller/ControllerHome.php');
                $this->_ctrl = new ControllerHome($url);
            }
        }
        catch(Exception $e)
        {
            $errorMsg = $e->getMessage();
            require_once ('View/viewError.php');
        }
    }
}