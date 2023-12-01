<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductAttribute extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function attributes(): HasOne
    {
        return $this->HasOne(Attribute::class, 'id', 'option_id');
    }
}
