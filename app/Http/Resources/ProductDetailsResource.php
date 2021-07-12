<?php

namespace App\Http\Resources;

use App\Models\WishList;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name_product,
            'image' => $this->image,
            'image_path'=>$this->product_image_path,
            'recomend' => $this->recomend,
            'desc' => $this->description,
            'sell' => $this->sell,
            'price' => $this->price,
            'size'=>$this->get_size(),
            'offer' => $this->get_offer(),
            'new_price' => $this->get_new_price(),
            'colors' => $this->get_color(),
            'is_wishlist' => $this->is_wishlist_to_user(),
        ];
    }
    public function is_wishlist_to_user()
    {
        $user = auth()->user();
        if ($user) {
            $wishlist = WishList::where('user_id', $user->id)->where('product_id', $this->id)->first();
            if ($wishlist) {
                return 1;
            }
        }
        return 0;
    }
    public function get_size()
    {
        if ($this->sizes) {
            $sizeProduct = $this->sizes;
        return SizeResource::collection($sizeProduct);
        }
        return "null" ;
    }
    public function get_color()
    {
        if ($this->colors) {
            $colorProduct = $this->colors;
        return ColorResource::collection($colorProduct);
        }
        return "null";
    }
    public function get_offer()
    {
        if ($this->offer) {
            $OfferProduct =  $this->offer;
            return $OfferProduct->value;
        }
        return "null";
    }
    public function get_new_price()
    {
        if ($this->offer) {
        $offer=$this->offer;
          $valueOffer=$offer->value;
          $price=$this->price;
          $newPrice=$price-$valueOffer*$price;
        return $newPrice;
    }else{
        return $this->price;
    }

    }
}

