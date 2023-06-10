<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\Product\Resource;
use App\Services\Product\ProductService;
use App\Http\Resources\Product\Collection;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->showAll(
            new Collection(
                $this->productService->getProducts(
                    $request->except(['order_by']), // criteria
                    $request->get('order_by', [])
                )
            )
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        if (! $product = $this->productService->getProductById($id)) {
            return $this->errorResponse(
                sprintf('Product with id %d is not found', $id),
                Response::HTTP_NOT_FOUND
            );
        }

        return $this->showOne(new Resource($product));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->showOne(
            new Resource(
                $this->productService->createProduct($request->all())
            ),
            Response::HTTP_CREATED
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        if (! $product = $this->productService->getProductById($id)) {
            return $this->errorResponse(
                sprintf('Product with id %d is not found', $id),
                Response::HTTP_NOT_FOUND
            );
        }

        return $this->showOne(
            new Resource(
                $this->productService->updateProduct($product, $request->all())
            ),
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if (! $product = $this->productService->getProductById($id)) {
            return $this->errorResponse(
                sprintf('Product with id %d is not found', $id),
                Response::HTTP_NOT_FOUND
            );
        }

        $this->productService->deleteProduct($product);

        return $this->noContentResponse();
    }
}
