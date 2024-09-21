<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'governorate_id',
        'name',
        'email',
        'phone',
        'address',
        'postal_code',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Define the relationship with the Governorate model.
     */
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }
}
