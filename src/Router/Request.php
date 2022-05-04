<?php

namespace App\Router;

use App\Entity\User\User;

class Request
{
    private string $method;
    private string $path;
    private array $query;
    private array $matches;
    private User $user;
    private object $userConnectInfos;
    private array $data;

    public function __construct(string $method, string $path, array $query = [], array $data = [])
    {
        $this->method = $method;
        $this->path = $path;
        $this->query = $query;
        $this->data = $data;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getSession(): array
    {
        return $this->session;
    }

    public function getMatches(): array
    {
        return $this->matches;
    }

    public function setMatches(array $matches): void
    {
        $this->matches = $matches;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getUserConnectInfos(): object
    {
        return $this->userConnectInfos;
    }

    public function setUserConnectInfos(object $userConnectInfos): void
    {
        $this->userConnectInfos = $userConnectInfos;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }



}
