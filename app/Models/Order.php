<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['attraction_id', 'quantity', 'price'];
    public function orderlists()
    {
        $this->hasMany(OrderList::class);
    }
}
