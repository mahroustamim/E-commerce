<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    use HasFactory;

    protected $fillable = ['governorate_en', 'governorate_ar', 'delivary_price'];

    public $timestamps = false;

    public function user() {
        
        return $this->hasMany(User::class);
        
    }
}
