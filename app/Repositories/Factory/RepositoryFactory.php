<?php

namespace App\Repositories\Factory;

use Exception;
use App\Exceptions\RepositoryFactoryException;
use App\Repositories\Interface\RepositoryInterface;

class RepositoryFactory
{
    /**
     * Create RepositoryInterface instance
     * @method createInstance(string $repositoryClassName)
     *
     * @param string $repositoryClassName The class name of the repository
     *
     * @return RepositoryInterface
     */
    public static function createInstance(string $repositoryClassName): RepositoryInterface
    {
        if (!class_exists($repositoryClassName)) {
            throw RepositoryFactoryException::classNotFound($repositoryClassName);
        }

        $repository = app($repositoryClassName);

        if (!$repository instanceof RepositoryInterface) {
            throw RepositoryFactoryException::invalidRepository($repositoryClassName);
        }

        return $repository;
    }
}
