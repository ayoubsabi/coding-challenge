<?php

namespace App\Exceptions;

use Exception;

class RepositoryFactoryException extends Exception
{
    /**
     * Create an exception for a missing repository class.
     *
     * @param string $className The name of the missing class
     * @return static
     */
    public static function classNotFound(string $className)
    {
        return new static(sprintf("The repository class '%s' was not found.", $className));
    }

    /**
     * Create an exception for an invalid repository instance.
     *
     * @param string $className The name of the invalid class
     * @return static
     */
    public static function invalidRepository(string $className)
    {
        return new static(sprintf("The class '%s' does not implement the RepositoryInterface.", $className));
    }
}
