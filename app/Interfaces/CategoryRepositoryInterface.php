<?php

namespace App\Interfaces;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{
    public function all($attributes = [], $all = false): LengthAwarePaginator|Collection;

    public function get($id): Category;
}
