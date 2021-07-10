<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class offer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'value', 'type'];
    public function products(){
        return $this->hasMany(Product::class,'offer_id');
    }
}
