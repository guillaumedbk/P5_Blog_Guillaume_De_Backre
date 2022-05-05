<?php

namespace App\Validator\Asserts;

use App\Validator\AssertInterface;

class AssertLength implements AssertInterface
{
    private int $min;
    private int $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function __invoke($value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        $length = strlen($value);
        if ($length < $this->min) {
            return "Should be greater than $this->min";
        }
        if ($length > $this->max) {
            return "Should be less than $this->max";
        }

        return null;
    }
}
