<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id',	'attraction_id',	'quantity', 	'price'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function attraction(){
        return $this->belongsTo(Attraction::class);
    }
}
