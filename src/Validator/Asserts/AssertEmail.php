<?php

namespace App\Validator\Asserts;

use App\Validator\AssertInterface;

class AssertEmail implements AssertInterface
{
    public function __invoke($value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (!strpos($value, '@')) {
            return 'Not valid email';
        }
        return null;
    }
}
