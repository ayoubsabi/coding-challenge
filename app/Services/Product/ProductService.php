<?php

namespace App\Services\Product;

use Exception;
use App\Rules\Exists;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Services\Utils\ValidatorService;
use Illuminate\Contracts\Pagination\Paginator;

class ProductService
{
    private $productRepository;
    private $validatorService;

    public function __construct(ProductRepository $productRepository, ValidatorService $validatorService)
    {
        $this->productRepository = $productRepository;
        $this->validatorService = $validatorService;
    }

    /**
     * @method getProducts(array $criteria, array $orderBy)
     *
     * @param array $criteria
     * @param array $orderBy
     *
     * @return Paginator
     */
    public function getProducts(array $criteria, array $orderBy): Paginator
    {
        $criteria = $this->validatorService->validate($criteria, [
            'name' => 'string',
            'sku' => 'string',
            'price' => 'numeric|min:1|max:9999999',
            'quantity' => 'numeric|min:1|max:9999999',
            'category_id' => [
                'integer',
                new Exists(CategoryRepository::class, 'id')
            ]
        ]);

        $orderBy = $this->validatorService->validate($orderBy, [
            'column' => 'string',
            'orientation' => 'in:asc,desc'
        ]);

        return $this->productRepository->findBy($criteria, $orderBy);
    }

    /**
     * @method getProductById(int $id)
     *
     * @param int $id
     *
     * @return Product|null
     */
    public function getProductById(int $id): ?Product
    {
        return $this->productRepository->findOneBy(['id' => $id]);
    }

    /**
     * @method createProduct(array $data)
     *
     * @param array $data
     *
     * @return Product
     */
    public function createProduct(array $data): Product
    {
        $data = $this->validatorService->validate($data, [
            'name' => 'required|string',
            'sku' => 'required|string',
            'price' => 'required|numeric|min:1|max:9999999',
            'quantity' => 'required|numeric|min:1|max:9999999',
            'category_id' => [
                'required',
                'integer',
                new Exists(CategoryRepository::class, 'id')
            ]
        ]);

        $product = $this->productRepository->create($data);

        Log::channel('custom')->info('User created a new product.', [
            'user_id' => auth()->user()->id,
            'product_id' => $product->id
        ]);

        return $product;
    }

    /**
     * @method updateProduct(Product $product, array $data)
     *
     * @param Product $product
     * @param array $data
     *
     * @return Product
     */
    public function updateProduct(Product $product, array $data): Product
    {
        $data = $this->validatorService->validate($data, [
            'name' => 'string',
            'sku' => 'string',
            'price' => 'numeric|min:1|max:9999999',
            'quantity' => 'numeric|min:1|max:9999999',
            'category_id' => [
                'integer',
                new Exists(CategoryRepository::class, 'id')
            ]
        ]);

        throw_if(
            ! $this->productRepository->update($product, $data),
            new Exception("Product update failure")
        );

        $product = $this->productRepository->create($data);

        Log::channel('custom')->info('User update a product.', [
            'user_id' => auth()->user()->id,
            'product_id' => $product->id
        ]);

        return $product;
    }

    /**
     * @method deleteProduct(Product $product)
     *
     * @param Product $product
     *
     * @return void
     */
    public function deleteProduct(Product $product): void
    {
        throw_if(
            ! $this->productRepository->delete($product),
            new Exception("Product delete failure")
        );

        Log::channel('custom')->info('User delete a product.', [
            'user_id' => auth()->user()->id,
            'product_id' => $product->id
        ]);
    }
}
