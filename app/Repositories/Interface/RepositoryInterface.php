<?php

namespace App\Repositories\Interface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\Paginator;

interface RepositoryInterface
{
    /**
     * @method findOneBy(array $criteria = [], array $columns = ['*'])
     *
     * @param array $criteria
     * @param array $columns
     *
     * @return Model|object|null
     */
    public function findOneBy(array $criteria = [], array $columns = ['*']): ?Model;

    /**
     * @method findBy(array $criteria = [], array $orderBy = [], int $itemPerPage = 10, array $columns = ['*'])
     *
     * @param array $criteria
     * @param array $orderBy
     * @param int $itemPerPage
     * @param array $columns
     *
     * @return Paginator
     */
    public function findBy(array $criteria = [], array $orderBy = [], int $itemPerPage = 10, array $columns = ['*']): Paginator;

    /**
     * @method findAll(array $orderBy = [], int $itemPerPage = 10, array $columns = ['*'])
     *
     * @param array $orderBy
     * @param int $itemPerPage
     * @param array $columns
     *
     * @return Paginator
     */
    public function findAll(array $orderBy = [], int $itemPerPage = 10, array $columns = ['*']): Paginator;
}
