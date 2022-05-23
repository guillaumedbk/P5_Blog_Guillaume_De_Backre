<?php

namespace App\Validator\Security;

class SecurePostData
{
    public function secureData(array $postData): array
    {
        foreach ($postData as &$value) {
            //AVOID XSS VULNERABILITIES
            $value = strip_tags($value);
            //AVOID SQL INJECTIONS
            $value = addslashes($value);
        }
        return $postData;
    }
}
