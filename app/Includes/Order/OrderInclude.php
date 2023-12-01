<?php

namespace App\Includes\Order;

use App\Includes\BaseInclude;
use Illuminate\Database\Eloquent\Builder;

class OrderInclude extends BaseInclude
{
    /**
     * Load 'orderProduct' relationship.
     *
     * @param  array|null  $fields
     * @return Builder
     */
    public function orderProduct(?array $fields): Builder
    {
        if (empty($fields)) {
            $fields = '*';
        } else {
            $fields = array_values(array_unique(array_merge(['id'], $fields)));
        }

        return $this->builder
            ->with(['orderProduct' => function ($query) use ($fields) {
                $query->select($fields);
            }]);
    }

    /**
     * Load 'orderTotal' relationship.
     *
     * @param  array|null  $fields
     * @return Builder
     */
    public function orderTotal(?array $fields): Builder
    {
        if (empty($fields)) {
            $fields = '*';
        } else {
            $fields = array_values(array_unique(array_merge(['id'], $fields)));
        }

        return $this->builder
            ->with(['orderTotal' => function ($query) use ($fields) {
                $query->select($fields);
            }]);
    }
}
