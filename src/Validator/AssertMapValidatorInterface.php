<?php

namespace App\Validator;

interface AssertMapValidatorInterface
{
    /**
     * @return array<AssertInterface>
     */
    public function getAsserts(): array;
}
