<?php

namespace App\Repositories;

use App\Interfaces\CartRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * OrderRepository constructor.
     *
     * @param  CartRepositoryInterface  $cartRepository
     */
    public function __construct(
        private CartRepositoryInterface $cartRepository
    ) {
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function all($attributes = [], $all = false): LengthAwarePaginator|Collection
    {
        $results = Order::field(data_get($attributes, 'fields'))
            ->include($attributes)
            ->filter(data_get($attributes, 'filter'));

        if ($all) {
            $results = $results->get();
        } else {
            $results = $results->paginate(data_get($attributes, 'per_page', config('globals.pagination.per_page')))
                ->appends(data_get($attributes, 'query'));
        }

        return $results;
    }

    public function summary($attributes = []): array
    {
        return $this->makeCartData($attributes);
    }

    public function create($attributes = []): bool
    {
        $success = DB::transaction(function () use ($attributes) {
            $orderData = $this->makeCartData($attributes);

            $order = Order::create($orderData['order']);
            $order->orderProduct()->createMany($orderData['order_products']);
            $order->orderTotal()->createMany($orderData['order_totals']);

            $this->user->cart()->delete();

            return true;
        });

        return $success ? true : false;
    }

    /**
     * @param $attributes
     * @return array
     */
    private function makeCartData($attributes): array
    {
        $data = [];
        $data['order'] = [
            'first_name' => $attributes['first_name'],
            'lastname' => $attributes['lastname'],
            'telephone' => $attributes['telephone'],
            'user_id' => $this->user->id,
            'email' => $this->user->email,
            'payment_firstname' => $attributes['payment_firstname'],
            'payment_lastname' => $attributes['payment_lastname'],
            'payment_company' => $attributes['payment_company'],
            'payment_address_1' => $attributes['payment_address_1'],
            'payment_address_2' => $attributes['payment_address_2'],
            'payment_city' => $attributes['payment_city'],
            'payment_postcode' => $attributes['payment_postcode'],
            'shipping_firstname' => $attributes['shipping_firstname'],
            'shipping_lastname' => $attributes['shipping_lastname'],
            'shipping_company' => $attributes['shipping_company'],
            'shipping_address_1' => $attributes['shipping_address_1'],
            'shipping_address_2' => $attributes['shipping_address_2'],
            'shipping_city' => $attributes['shipping_city'],
            'shipping_postcode' => $attributes['shipping_postcode'],
        ];

        $data['order_products'] = [];
        $orderTotals = 0;
        $cartProducts = $this->cartRepository->all([
            'filter' => [
                'user_id' => $this->user->id,
            ],
        ]);

        if ($cartProducts) {
            foreach ($cartProducts as $key => $product) {
                $data['order_products'][] = [
                    'product_id' => $product->product_id,
                    'name' => $product->product_name,
                    'quantity' => $product->quantity,
                    'price' => $product->price,
                ];

                $orderTotals += $product->price;
            }
        }

        $data['order']['total'] = $orderTotals;

        $data['order_totals'][] = [
            'title' => 'Grand Total',
            'value' => $orderTotals,
        ];

        return $data;
    }
}
