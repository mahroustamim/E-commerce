<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'final_price', 'status', 'payment_status', 'payment_method', 'payment_id', 'postal_code'];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function product()
    {
        $this->belongsTo(Product::class);
    }

}
