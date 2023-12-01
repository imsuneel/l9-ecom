<?php

namespace App\Repositories;

use App\Interfaces\CartRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CartRepository implements CartRepositoryInterface
{
    /**
     * CategoryController constructor.
     *
     * @param  User  $user
     * @param  ProductRepositoryInterface  $productRepository
     */
    public function __construct(
        public User $user,
        private ProductRepositoryInterface $productRepository,
    ) {
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function all($attributes = []): Collection
    {
        return Cart::field(data_get($attributes, 'fields'))
            ->include($attributes)
            ->filter(data_get($attributes, 'filter'))
            ->get();
    }

    public function delete($id, $attributes = []): bool
    {
        // TODO: Implement delete() method.
    }

    public function create($attributes = []): bool
    {
        $success = DB::transaction(function () use ($attributes) {
            $cartQuery = Cart::where('user_id', $this->user->id);
            $cartQuery->where('product_id', $attributes['product_id']);

            if (isset($attributes['cart_id']) && $attributes['cart_id'] != '') {
                $cartQuery->where('id', $attributes['cart_id']);
            }
            $cart = $cartQuery->first();
            if ($cart) {
                $cartData = $this->makeCartData($attributes);
                Cart::find($cart->id)->update($cartData);
            } else {
                $cartData = $this->makeCartData($attributes);
                Cart::create($cartData);
            }

            return true;
        });

        return $success ? true : false;
    }

    public function update($id, $attributes = []): bool
    {
        // TODO: Implement update() method.
    }

    private function makeCartData($attributes = [])
    {
        $product = $this->productRepository->get($attributes['product_id']);
        $quantity = (isset($attributes['quantity']) ? $attributes['quantity'] : 1);

        return [
            'user_id' => $this->user->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'quantity' => $quantity,
            'price' => $quantity * $product->price,
        ];
    }
}
