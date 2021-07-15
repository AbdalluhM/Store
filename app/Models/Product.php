<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Color;
use App\Models\offer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'name_product', 'description', 'price', 'image', 'offer_id', 'qty','recomend'];
    protected $appends = ['product_image_path'];




    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function offer()
    {
        return $this->belongsTo(offer::class,'offer_id');
    }
    public function ordersDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
    public function colors()
    {
        return $this->hasMany(Color::class);
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }
    public function wishlists()
    {
        return $this->hasMany(WishList::class);
    }
    public function carts()
    {
        return $this->hasMany(cart::class);
    }
    public function getProductImagePathAttribute()
    {
        return asset('storage/images/products/' . ($this->image));
    }

    public function hasSize($sizeId){
        return in_array($sizeId,$this->sizes->pluck('id')->toArray());
    }
    // public function hasOffer($offerId){
    //     return in_array($offerId,$this->sizes->pluck('id')->toArray());
    // }
}
