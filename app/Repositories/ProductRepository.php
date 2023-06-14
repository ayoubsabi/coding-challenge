<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;
use App\Repositories\BaseRepository\Repository;

/**
 * @method Product|null     findOneBy(array $criteria = [], array $columns = ['*'])
 * @method Paginator        findBy(array $criteria = [], array $orderBy = [], int $itemPerPage = 10, array $columns = ['*'])
 * @method Paginator        findAll(array $orderBy = [], int $itemPerPage = 10, array $columns = ['*'])
 */
class ProductRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(
            app(Product::class)
        );
    }

    /**
     * @method create(array $data)
     *
     * @param array $data
     *
     * @return Product
     */
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    /**
     * @method update(Product $product, array $data)
     *
     * @param Product $product
     * @param array $data
     *
     * @return bool
     */
    public function update(Product $product, array $data): bool
    {
        return $product->update($data);
    }

    /**
     * @method delete(Product $product)
     *
     * @param Product $product
     *
     * @return bool
     */
    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
