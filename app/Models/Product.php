<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = ['name_en', 'name_ar', 'category_id', 'price', 'discount', 'quantity', 'desc_en', 'desc_ar','brand_en', 'brand_ar', 'status', 'colors', 'sizes', 'photo', 'creator'];

    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
    ];

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    // public function order()
    // {
    //     return $this->hasMany(Order::class);
    // }

    public function image()
    {
        return $this->hasMany(Image::class);
    }
}
