<?php

namespace App\Models;

use App\Traits\Eloquent\Order\OrderScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use OrderScope, HasFactory;

    protected $guarded = [];

    /**
     * Get the orderProduct associated with the user.
     */
    public function orderProduct(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * Get the orderProduct associated with the user.
     */
    public function orderTotal(): HasMany
    {
        return $this->hasMany(OrderTotal::class);
    }
}
