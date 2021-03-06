<?php

namespace App\Router;

use App\Exceptions\ControllerNotFoundException;

class Router
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @throws ControllerNotFoundException
     */

    public function execute(Request $request)
    {
        foreach ($this->routes as $pattern => $config) {
            $matches = [];
            if (preg_match($pattern, $request->getPath(), $matches) === 1 && \in_array($request->getMethod(), $config['methods'], true)) {
                $request->setMatches($matches);
                return $config['controller']($request);
            }
        }

        throw new ControllerNotFoundException($request);
    }
}
