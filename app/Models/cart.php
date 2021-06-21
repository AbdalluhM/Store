<?php

namespace App\Models;

use App\Models\address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'total_price',
        'qty',
    ];

    use HasFactory;
    public function address(){
        return $this->belongsTo(address::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }


}
