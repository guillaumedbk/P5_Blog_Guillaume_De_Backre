<?php
namespace Exceptions;

use App\Router\Request;

class ControllerNotFoundException extends \Exception
{
    private Request $request;

    public function __construct(Request $request)
    {
        parent::__construct('Controller not found');
        $this->request = $request;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}