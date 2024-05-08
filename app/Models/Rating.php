<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'rating'];

    public function product()
    {
        $this->belongsTo(Product::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
