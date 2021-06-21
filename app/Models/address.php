<?php

namespace App\Models;

use App\Models\cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class address extends Model
{
    use HasFactory;
    protected $fillable=['user_id','number_house','street','landmark','city_id','type_house','order_owner','mobile','state_id'];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function carts(){
        return $this->hasMany(cart::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function city(){
        return $this->belongsTo(User::class);
    }
    public function state(){
        return $this->belongsTo(User::class);
    }

}
