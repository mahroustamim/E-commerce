<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['city_en', 'city_ar', 'delivary_price'];

    public function userAdress() {
        
        return $this->hasOne(UserDetail::class);
        
    }
}
