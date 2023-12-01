<?php

namespace App\Traits\Eloquent\Order;

use App\Filters\Order\OrderFilter;
use App\Includes\Order\OrderInclude;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait OrderScope
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
        if (empty($fields['orders'])) {
            $fields = '*';
        } else {
            $fields = Str::snap($fields['orders']);
            $fields = array_values(array_unique(array_merge(['id'], $fields)));
        }

        $query->select($fields);
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
        return (new OrderInclude($builder, $attributes))->apply();
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
        return (new OrderFilter($builder, $filters))->apply();
    }
}
