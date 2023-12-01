<?php

namespace App\Filters\Cart;

use App\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CartFilter extends BaseFilter
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
    public function userId(string|int $value): Builder
    {
        return $this->builder->where('user_id', Str::snap($value));
    }
}
