<?php

namespace App\Includes\Cart;

use App\Includes\BaseInclude;
use Illuminate\Database\Eloquent\Builder;

class CartInclude extends BaseInclude
{
    /**
     * Load 'product' relationship.
     *
     * @param  array|null  $fields
     * @return Builder
     */
    public function product(?array $fields): Builder
    {
        if (empty($fields)) {
            $fields = '*';
        } else {
            $fields = array_values(array_unique(array_merge(['product'], $fields)));
        }

        return $this->builder
            ->with(['product' => function ($query) use ($fields) {
                $query->select($fields);
            }]);
    }
}
