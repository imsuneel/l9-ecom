<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all($attributes = [], $all = false): LengthAwarePaginator|Collection
    {
        return Category::get();
    }

    public function get($id): Category
    {
        return Category::findOrFail($id);
    }
}
