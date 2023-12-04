<?php

namespace App\Http\Controllers\Api\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\Cart\CartResourceCollection;
use App\Http\Resources\Order\OrderSummaryResource;
use App\Interfaces\CartRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * CategoryController constructor.
     *
     * @param  OrderRepositoryInterface  $orderRepository
     * @param  CartRepositoryInterface  $cartRepository
     */
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private CartRepositoryInterface $cartRepository
    ) {
    }

    /**
     * @param  Request  $request
     */
    public function index(Request $request)
    {
        $attributes = $request->all();
        $attributes['query'] = $request->query();
        $this->orderRepository->setUser($request->user());

        $results = $this->orderRepository->all($attributes);

        return response()->success(new CartResourceCollection($results), Response::HTTP_OK, true);
    }

    public function summary(OrderStoreRequest $request)
    {
        $attributes = $request->all();

        $cartProducts = $this->cartRepository->all([
            'filter' => [
                'user_id' => $request->user()->id,
            ],
        ]);

        if (! $cartProducts->count()) {
            return response()->error(trans('system.cart.empty'), [], Response::HTTP_BAD_REQUEST);
        }
        $this->orderRepository->setUser($request->user());

        return response()->success((new OrderSummaryResource($this->orderRepository->summary($attributes))), Response::HTTP_OK);
    }

    public function store(OrderStoreRequest $request)
    {
        $attributes = $request->all();

        $cartProducts = $this->cartRepository->all([
            'filter' => [
                'user_id' => $request->user()->id,
            ],
        ]);

        if (! $cartProducts->count()) {
            return response()->error(trans('system.cart.empty'), [], Response::HTTP_BAD_REQUEST);
        }

        $this->orderRepository->setUser($request->user());
        $success = $this->orderRepository->create($attributes);

        if ($success) {
            $message = trans('system.order.created');

            return response()->success(compact('message'), Response::HTTP_OK);
        } else {
            return response()->error();
        }
    }
}
