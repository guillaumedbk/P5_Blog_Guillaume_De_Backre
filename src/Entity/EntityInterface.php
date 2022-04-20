<?php
namespace App\Entity;

interface EntityInterface
{
    public static function createFromDb(array $element):self;
}
