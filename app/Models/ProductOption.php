<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductOption extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function options(): HasOne
    {
        return $this->hasOne(Option::class, 'id', 'option_id');
    }
}
