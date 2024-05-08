<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['city', 'delivery_price'];

    public function adress() 
    {
        $this->hasOne(UserAdress::class);
    }

}
