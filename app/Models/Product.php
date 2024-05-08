<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'image_id', 'category_id', 'main_price', 'main_discount', 'desc'];

    public function rating()
    {
        $this->hasOne(Rating::class);
    }
    
    public function productDetails()
    {
        $this->hasOne(ProductDetails::class);
    }

    public function category()
    {
        $this->belongsTo(Category::class);
    }
    
    public function comment()
    {
        $this->hasMany(Comment::class);
    }

    public function order()
    {
        $this->hasMany(Order::class);
    }

    public function image()
    {
        $this->hasMany(Image::class);
    }

}
