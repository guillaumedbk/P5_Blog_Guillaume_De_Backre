<?php

namespace App\Router;

use App\Entity\User\User;

class Request
{
    private string $method;
    private string $path;
    private array $querry;
    private array $matches;
    private User $user;
    private object $userConnectInfos;

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

    public function getMatches(): array
    {
        return $this->matches;
    }

    public function setMatches(array $matches): void
    {
        $this->matches = $matches;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return object
     */
    public function getUserConnectInfos(): object
    {
        return $this->userConnectInfos;
    }

    /**
     * @param object $userConnectInfos
     */
    public function setUserConnectInfos(object $userConnectInfos): void
    {
        $this->userConnectInfos = $userConnectInfos;
    }

}
