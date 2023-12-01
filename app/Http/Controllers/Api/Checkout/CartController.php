<?php

namespace App\Http\Controllers\Api\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Resources\Cart\CartResourceCollection;
use App\Interfaces\CartRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    /**
     * CategoryController constructor.
     *
     * @param  ProductRepositoryInterface  $productRepository
     * @param  CartRepositoryInterface  $cartRepository
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private CartRepositoryInterface $cartRepository
    ) {
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @param  Request  $request
     */
    public function index(Request $request)
    {
        $attributes = $request->all();
        $attributes['query'] = $request->query();
        $this->cartRepository->setUser($request->user());

        $results = $this->cartRepository->all($attributes);

        return response()->success(new CartResourceCollection($results), Response::HTTP_OK, true);
    }

    public function store(CartRequest $request)
    {
        $attributes = $request->all();
        $attributes['query'] = $request->query();
        $this->cartRepository->setUser($request->user());
        $success = $this->cartRepository->create($attributes);

        if ($success) {
            $message = $request->filled('cart_id')
                ? trans('system.cart.updated')
                : trans('system.cart.created');

            return response()->success(compact('message'), Response::HTTP_OK);
        } else {
            return response()->error();
        }
    }
}
