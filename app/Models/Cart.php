<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable=[
        'bale_user_id',
        'product_id',
        'count',
    ];

    public function baleUser(): BelongsTo
    {
       return $this->belongsTo(BaleUser::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
