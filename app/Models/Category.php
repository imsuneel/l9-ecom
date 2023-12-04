<?php

namespace App\Models;

use App\Traits\Eloquent\Category\CategoryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use CategoryScope, HasFactory;

    /**
     * @return HasMany
     */
    public function productToCategory(): HasMany
    {
        return $this->hasMany(ProductToCategory::class);
    }
}
