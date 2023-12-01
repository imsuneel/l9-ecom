<?php

namespace App\Traits\Eloquent\Product;

use App\Filters\Product\ProductFilter;
use App\Includes\Product\ProductInclude;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait ProductScope
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
        if (empty($fields['products'])) {
            $fields = '*';
        } else {
            $fields = Str::snap($fields['products']);
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
        return (new ProductInclude($builder, $attributes))->apply();
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
        return (new ProductFilter($builder, $filters))->apply();
    }
}
