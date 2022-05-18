<?php

namespace App\Validator\Validators;

use App\Repository\DBConnexion;
use App\Repository\UserRepository;
use App\Validator\AssertMapValidatorInterface;
use App\Validator\Asserts\AssertEmail;
use App\Validator\Asserts\AssertEmailUniquess;
use App\Validator\Asserts\AssertLength;
use App\Validator\Asserts\AssertNotBlank;

class SignUpAssertMapValidator implements AssertMapValidatorInterface
{
    private array $asserts;

    public function __construct()
    {
        $this->asserts = [
            'firstname' => [
                new AssertNotBlank(),
                new AssertLength(3, 255)
            ],
            'name' => [
                new AssertNotBlank(),
                new AssertLength(3, 255),
            ],
            'email' => [
                new AssertNotBlank(),
                new AssertLength(5, 40),
                new AssertEmail(),
                new AssertEmailUniquess()
            ],
            'password' => [
                new AssertNotBlank(),
                new AssertLength(4, 60),
            ],
            'bio' => [
                new AssertNotBlank(),
                new AssertLength(2, 300),
            ],
        ];
    }

    public function getAsserts(): array
    {
        return $this->asserts;
    }
}