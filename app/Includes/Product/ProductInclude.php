<?php

namespace App\Includes\Product;

use App\Includes\BaseInclude;
use Illuminate\Database\Eloquent\Builder;

class ProductInclude extends BaseInclude
{
    /**
     * Load 'productToCategory' relationship.
     *
     * @param  array|null  $fields
     * @return Builder
     */
    public function productToCategory(?array $fields): Builder
    {
        if (empty($fields)) {
            $fields = '*';
        } else {
            $fields = array_values(array_unique(array_merge(['product_id'], $fields)));
        }
        $attributes = $this->attributes;

        return $this->builder
            ->with(['productToCategory.category' => function ($query) use ($fields, $attributes) {
                $query->select($fields);
                if (isset($attributes['filter']['category_id']) && $attributes['filter']['category_id'] != '') {
                    $query->where('id', $attributes['filter']['category_id']);
                }

                if (isset($attributes['filter']['category_name']) && $attributes['filter']['category_name'] != '') {
                    $query->where('name', 'LIKE', '%'.$attributes['filter']['category_name'].'%');
                }
            }]);
    }

    /**
     * Load 'productToCategory' relationship.
     *
     * @param  array|null  $fields
     * @return Builder
     */
    public function options(?array $fields): Builder
    {
        if (empty($fields)) {
            $fields = '*';
        } else {
            $fields = array_values(array_unique(array_merge(['product_id'], $fields)));
        }

        return $this->builder
            ->with(['productOption.options' => function ($query) use ($fields) {
                $query->select($fields);
            }]);
    }

    /**
     * Load 'productToCategory' relationship.
     *
     * @param  array|null  $fields
     * @return Builder
     */
    public function attributes(?array $fields): Builder
    {
        if (empty($fields)) {
            $fields = '*';
        } else {
            $fields = array_values(array_unique(array_merge(['product_id'], $fields)));
        }

        return $this->builder
            ->with(['productAttribute.attributes' => function ($query) use ($fields) {
                $query->select($fields);
            }]);
    }
}
