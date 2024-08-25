<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use softDeletes;
    use HasFactory;
    
    protected $fillable = ['name_en', 'name_ar', 'category_id', 'price', 'discount', 'quantity', 'desc_en', 'desc_ar', 'status_en', 'status_ar', 'colors_en', 'colors_ar', 'sizes'];

    protected $casts = [
        'colors_en' => 'array',
        'colors_ar' => 'array',
        'sizes' => 'array',
    ];

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
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
