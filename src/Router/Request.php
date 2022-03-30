<?php

namespace App\Router;

class Request
{
    private string $method;
    private string $path;
    private array $querry;

    public function __construct(string $method, string $path, array $querry = [])
    {
        $this->method = $method;
        $this->path = $path;
        $this->querry = $querry;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getQuerry(): array
    {
        return $this->querry;
    }
}