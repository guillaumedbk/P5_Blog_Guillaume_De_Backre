<?php

namespace App\Router;

use App\Entity\Comment\Comment;
use App\Entity\User\User;
use App\Repository\UserSession;

class Request
{
    private string $method;
    private string $path;
    private array $matches;
    private User $user;
    private array $session;
    private array $data;
    private array $query;

    public function __construct(string $method, string $path, array $session, array $data = [], array $query = [])
    {
        $this->method = $method;
        $this->path = $path;
        $this->session = $session;
        $this->data = $data;
        $this->query = $query;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
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

    public function getSession(): array
    {
        return $this->session;
    }

    public function setSession(array $session): void
    {
        $this->session = $session;
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
