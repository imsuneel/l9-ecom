<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductResourceCollection;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * CategoryController constructor.
     *
     * @param  ProductRepositoryInterface  $productRepository
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository,
    ) {
    }

    /**
     * @param  Request  $request
     */
    public function index(Request $request)
    {
        $attributes = $request->all();
        $attributes['query'] = $request->query();

        $results = $this->productRepository->all($attributes, $request->filled('all'));

        return response()->success(new ProductResourceCollection($results), Response::HTTP_OK, true);
    }

    public function show(Request $request, $id)
    {
        $attributes = $request->all();
        $attributes['query'] = $request->query();

        return response()->success((new ProductResource($this->productRepository->get($id, $attributes))));
    }
}
