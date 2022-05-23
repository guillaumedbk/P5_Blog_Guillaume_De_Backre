<?php

namespace App\Validator\Asserts;

use App\Validator\AssertInterface;

class AssertNotBlank implements AssertInterface
{
    public function __invoke($value): ?string
    {
        if ($value === null || $value === '') {
            return 'Should be not blank';
        }

        return null;
    }
}
