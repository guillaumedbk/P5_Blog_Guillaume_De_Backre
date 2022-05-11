<?php

namespace App\Entity\User;

use App\Entity\User\User;
use App\Router\Request;

class UserSession
{
    public function __construct(User $user)
    {
        $this->addSessionKey('TOKEN', md5(time()*rand(153, 728)));
        $this->addSessionKey('LOGGED', true);
        $this->addSessionKey('USER', $user);
    }

    public function addSessionKey(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function getSessionKey($key)
    {
        return $_SESSION[$key];
    }

    public function isLogged(): bool
    {
        if (session_status() === PHP_SESSION_ACTIVE && $_SESSION['LOGGED'] === true) {
            return true;
        } else {
            return false;
        }
    }
}
