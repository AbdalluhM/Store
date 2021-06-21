<?php

namespace App\Models;

use App\Models\cart;
use App\Models\Order;
use App\Models\address;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function carts(){
        return $this->hasMany(cart::class);
    }
    public function addresses(){
        return $this->hasMany(address::class);
    }
    public function wishLists(){
        return $this->hasMany(WishList::class);
    }

    public function socials(){
        return $this->hasMany(Social::class);
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
