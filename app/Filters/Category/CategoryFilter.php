<?php

namespace App\Filters\Category;

use App\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class CategoryFilter extends BaseFilter
{
    /**
     * Get records matching ID.
     *
     * @param  string|int|array  $value
     * @return Builder
     */
    public function id(string|int|array $value): Builder
    {
        return $this->builder->where('id', Str::snap($value));
    }
}
