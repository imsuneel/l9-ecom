<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Category\CategoryResourceCollection;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     *
     * @param  CategoryRepositoryInterface  $categoryRepository
     */
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
    ) {
    }

    /**
     * @param  Request  $request
     */
    public function index(Request $request)
    {
        $attributes = $request->all();

        return response()->success((new CategoryResourceCollection($this->categoryRepository->all($attributes, true))));
    }

    public function show(Request $request, $id)
    {
        return response()->success((new CategoryResource($this->categoryRepository->get($id))));
    }
}
