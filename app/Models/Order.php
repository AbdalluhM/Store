<?php

namespace App\Models;

use App\Models\User;
use App\Models\address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','address_id','number_order','total_price','status'];
    public function adress()
    {
        return $this->belongsTo(address::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function orderDetails(){
        return $this->hasMany(orderDetails::class);
    }
}
