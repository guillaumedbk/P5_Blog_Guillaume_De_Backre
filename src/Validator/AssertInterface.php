<?php

namespace App\Validator;

interface AssertInterface
{
    public function __invoke($value): ?string;
}