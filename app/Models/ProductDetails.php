<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'color_id', 'size_id', 'quantity', 'discount', 'status'];

    public function color()
    {
        $this->hasMany(Color::class);
    }

    public function size()
    {
        $this->hasMany(Size::class);
    }

    public function product()
    {
        $this->belongsTo(Product::class);
    }

    public function orderDetails()
    {
        $this->hasOne(OrderDetails::class);
    }

}
