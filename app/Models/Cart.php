<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    // Set the table name if it's not the plural of the model name
    protected $table = 'carts';

    // Set the primary key type and column
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    // Define the fillable attributes
    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'cookie_id',
        'quantity',
        'color',
        'size',
    ];

    // Define relationships if necessary
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
