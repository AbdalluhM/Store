<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;
    protected $fillable = ['size'];
    public $timestamps = false;
    public function products()
{
    return $this->belongsToMany(Product::class);
}
}
