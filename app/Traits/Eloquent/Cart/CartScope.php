<?php

namespace App\Traits\Eloquent\Cart;

use App\Filters\Cart\CartFilter;
use App\Includes\Cart\CartInclude;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait CartScope
{
    /**
     * Default fields scope.
     *
     * @param  Builder  $query
     * @param  array|null  $fields
     * @return void
     */
    public function scopeField(Builder $query, ?array $fields)
    {
        if (empty($fields['carts'])) {
            $fields = '*';
        } else {
            $fields = Str::snap($fields['carts']);
            $fields = array_values(array_unique(array_merge(['id'], $fields)));
        }

        $query->select($fields);
    }

    /**
     * Default filter scope.
     *
     * @param  Builder  $builder
     * @param  array|null  $filters
     * @return Builder
     */
    public function scopeFilter(Builder $builder, ?array $filters)
    {
        return (new CartFilter($builder, $filters))->apply();
    }

    /**
     * Default include scope.
     *
     * @param  Builder  $builder
     * @param  array|null  $attributes
     * @return Builder
     */
    public function scopeInclude(Builder $builder, ?array $attributes)
    {
        return (new CartInclude($builder, $attributes))->apply();
    }
}
