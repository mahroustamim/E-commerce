<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number',
        'status',
        'payment_status',
        'payment_method',
        'total_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the formatted total price (if needed).
     */
    public function getFormattedTotalPriceAttribute()
    {
        return number_format($this->total_price, 2);
    }
}