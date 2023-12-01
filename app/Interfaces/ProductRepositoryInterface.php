<?php

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function all($attributes = [], $all = false): LengthAwarePaginator|Collection;

    public function get($id, $attributes = []): Product;
}
