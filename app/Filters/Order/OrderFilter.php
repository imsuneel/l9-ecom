<?php

namespace App\Filters\Order;

use App\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class OrderFilter extends BaseFilter
{
    /**
     * Get records matching User ID.
     *
     * @param  string|int|array  $value
     * @return Builder
     */
    public function userId(string|int|array $value): Builder
    {
        return $this->builder->where('id', Str::snap($value));
    }
}
