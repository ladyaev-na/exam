<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'description', 'category_attraction_id'];

    public function attractionc(){
        return $this->belongsTo(CategoryAttraction::class);
    }
    public function carts(){
        $this->hasMany(Cart::class);
    }
}
