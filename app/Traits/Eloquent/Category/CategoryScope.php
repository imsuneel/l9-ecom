<?php

namespace App\Traits\Eloquent\Category;

use App\Filters\Category\CategoryFilter;
use App\Includes\Category\CategoryInclude;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait CategoryScope
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
        if (empty($fields['categories'])) {
            $fields = '*';
        } else {
            $fields = Str::snap($fields['categories']);
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
        return (new CategoryInclude($builder, $attributes))->apply();
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
        return (new CategoryFilter($builder, $filters))->apply();
    }
}
