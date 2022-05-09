<?php

namespace App\Validator\Validators;

use App\Validator\AssertMapValidatorInterface;
use App\Validator\Asserts\AssertLength;
use App\Validator\Asserts\AssertNotBlank;

class PostAssertMapValidator implements AssertMapValidatorInterface
{
    private array $asserts;

    public function __construct()
    {
        $this->asserts = [
            'title' => [
                new AssertNotBlank(),
                new AssertLength(2, 255)
            ],
            'chapo' => [
                new AssertNotBlank(),
                new AssertLength(2, 255)
            ],
            'content' => [
                new AssertNotBlank(),
            ],
        ];
    }

    public function getAsserts(): array
    {
        return $this->asserts;
    }
}