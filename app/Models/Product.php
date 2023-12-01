<?php

namespace App\Models;

use App\Traits\Eloquent\Product\ProductScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use ProductScope, HasFactory;

    /**
     * @return HasMany
     */
    public function productToCategory(): HasMany
    {
        return $this->hasMany(ProductToCategory::class);
    }

    /**
     * @return HasMany
     */
    public function productAttribute(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * @return HasMany
     */
    public function productOption(): HasMany
    {
        return $this->hasMany(ProductOption::class);
    }

    /**
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url($value),
        );
    }
}
