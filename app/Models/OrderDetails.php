<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'product_details_id', 'price', 'quantity', 'discout'];

    public function order()
    {
        $this->belongsTo(Order::class);
    }
    
    public function productDetails()
    {
        $this->belongsTo(ProductDetails::class);
    }

}
