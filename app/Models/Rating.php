<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'rating'];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function product()
    {
        $this->belongsTo(Product::class);
    }
    
}
