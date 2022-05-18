<?php

namespace App\Validator\Asserts;

use App\Repository\DBConnexion;
use App\Repository\UserRepository;
use App\Validator\AssertInterface;

class AssertEmail implements AssertInterface
{
    public function __invoke($value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            return 'Not valid email';
        }
        return null;
    }
}
