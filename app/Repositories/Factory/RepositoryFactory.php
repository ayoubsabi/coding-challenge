<?php

namespace App\Repositories\Factory;

use Exception;
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
        throw_if(
            ! class_exists($repositoryClassName),
            new Exception(sprintf("%s class not found", $repositoryClassName))
        );

        $repository = app($repositoryClassName);

        throw_if(
            ! $repository instanceof RepositoryInterface,
            new Exception(sprintf("This class is not an instance of %s", RepositoryInterface::class))
        );

        return $repository;
    }
}
