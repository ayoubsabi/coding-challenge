<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Category\CategoryService;
use App\Http\Resources\Category\Collection;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
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
                $this->categoryService->getCategories(
                    $request->except(['order_by']), // criteria
                    $request->get('order_by', [])
                )
            )
        );
    }
}
