<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'desc', 'image', 'color'];
    protected $appends = ['product_image_path'];
    public $timestamps = false;

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function getProductImagePathAttribute()
    {
        return asset('storage/images/colors/' . ($this->image));
    }
}
