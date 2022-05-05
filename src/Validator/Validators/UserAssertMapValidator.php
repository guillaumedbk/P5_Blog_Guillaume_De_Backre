<?php

namespace App\Validator\Validators;
use App\Validator\AssertMapValidatorInterface;
use App\Validator\Asserts\AssertEmail;
use App\Validator\Asserts\AssertLength;
use App\Validator\Asserts\AssertNotBlank;

class UserAssertMapValidator implements AssertMapValidatorInterface
{
    private array $asserts;

    public function __construct()
    {
        $this->asserts = [
            'email' => [
                new AssertNotBlank(),
                new AssertLength(5, 40),
                new AssertEmail(),
            ],
            'password' => [
                new AssertLength(6, 60),
            ],
        ];
    }

    public function getAsserts(): array
    {
        return $this->asserts;
    }
}