<?php

namespace App\Exceptions;

class EntityNotFoundException extends \Exception
{
    private string $class;

    /**
     * @param string $class
     */
    public function __construct(string $class)
    {
        parent::__construct('Entity not found');
        $this->class = $class;
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
