<?php

namespace App\Filters\Product;

use App\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProductFilter extends BaseFilter
{
    /**
     * Get records matching Product ID.
     *
     * @param  string|int|array  $value
     * @return Builder
     */
    public function ProductId(string|int|array $value): Builder
    {
        return $this->builder->where('id', Str::snap($value));
    }

    /**
     * Get records matching Product Name.
     *
     * @param  string|int  $value
     * @return Builder
     */
    public function ProductName(string|int $value): Builder
    {
        return $this->builder->where('name', 'LIKE', '%'.$value.'%');
    }
}
