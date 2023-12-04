<?php

namespace App\Includes\Category;

use App\Includes\BaseInclude;
use Illuminate\Database\Eloquent\Builder;

class CategoryInclude extends BaseInclude
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
            $fields = array_values(array_unique(array_merge(['category_id'], $fields)));
        }

        return $this->builder
            ->with(['productToCategory.product' => function ($query) use ($fields) {
                $query->select($fields);
            }]);
    }
}
