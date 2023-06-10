<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Contracts\Pagination\Paginator;
use App\Repositories\BaseRepository\Repository;

/**
 * @method Category|null    findOneBy(array $criteria = [], array $columns = ['*'])
 * @method Paginator        findBy(array $criteria = [], array $orderBy = [], int $itemPerPage = 10, array $columns = ['*'])
 * @method Paginator        findAll(array $orderBy = [], int $itemPerPage = 10, array $columns = ['*'])
 */
class CategoryRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Category::class);
    }

    /**
     * @method create(array $data)
     *
     * @param array $data
     *
     * @return Category
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * @method update(Category $category, array $data)
     *
     * @param Category $category
     * @param array $data
     *
     * @return bool
     */
    public function update(Category $category, array $data): bool
    {
        return $category->update($data);
    }

    /**
     * @method delete(Category $category)
     *
     * @param Category $category
     *
     * @return bool
     */
    public function delete(Category $category): bool
    {
        return $category->delete();
    }
}
