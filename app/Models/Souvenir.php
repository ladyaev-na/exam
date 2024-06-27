<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Souvenir extends Model
{
    use HasFactory;
    public function souvenirC(){
        return $this->belongsTo(SouvenirC::class);
    }
    public function carts(){
        $this->hasMany(Cart::class);
    }
}
