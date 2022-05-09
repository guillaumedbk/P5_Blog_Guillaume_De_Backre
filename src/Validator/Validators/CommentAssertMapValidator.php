<?php

namespace App\Validator\Validators;

use App\Validator\AssertMapValidatorInterface;
use App\Validator\Asserts\AssertEmail;
use App\Validator\Asserts\AssertLength;
use App\Validator\Asserts\AssertNotBlank;

class CommentAssertMapValidator implements AssertMapValidatorInterface
{
    private array $asserts;

    public function __construct()
    {
        $this->asserts = [
            'comment' => [
                new AssertNotBlank(),
            ],
        ];
    }

    public function getAsserts(): array
    {
        return $this->asserts;
    }
}