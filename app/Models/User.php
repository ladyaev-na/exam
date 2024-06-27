<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [ 'surname', 'name', 'login', 'password', 'role_id'];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function carts(){
        $this->hasMany(Cart::class);
    }

    public  function hasRole($roles){
        return in_array($this->role->code, $roles);
    }
}
