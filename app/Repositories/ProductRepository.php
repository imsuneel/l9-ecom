<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    public function all($attributes = [], $all = false): LengthAwarePaginator|Collection
    {
        $results = Product::field(data_get($attributes, 'fields'))
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

    public function get($id, $attributes = []): Product
    {
        return Product::field(data_get($attributes, 'fields'))
            ->include($attributes)
            ->filter(data_get($attributes, 'filter'))
            ->findOrFail($id);
    }
}
