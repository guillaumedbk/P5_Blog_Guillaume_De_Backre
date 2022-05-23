<?php

namespace App\Validator\Validators;

use App\Validator\AssertMapValidatorInterface;

class Validator
{
    /**
     * @return array<string, array<string>>
     */
    public function validate(AssertMapValidatorInterface $validator, object $dto): array
    {
        $errors = [];

        foreach ($validator->getAsserts() as $key => $asserts) {
            foreach ($asserts as $assert) {
                $result = $assert($dto->{$key});
                if ($result !== null) {
                    $errors[$key][] = $result;
                }
            }
        }
        return $errors;
    }
}
