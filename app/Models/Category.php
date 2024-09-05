<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name_en', 'name_ar', 'image'];

    public function products() {

        return $this->hasMany(Product::class, 'category_id', 'id');

    }

    // protected $appends = ['name'];

    // public function getNameAttribute() 
    // {
    //     $locale = app()->getLocale();
    //     return $this->attributes['name_' . $locale];
    // }
}
