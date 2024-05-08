<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdress extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'city_id', 'address', 'postal_code'];

    public function adress()
    {
        $this->belongsTo(City::class);
    }
}
