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
            'recomend' => $this->recomend,
            'desc' => $this->description,
            'sell' => $this->sell,
            'price' => $this->price,
            'size'=>$this->get_size(),
            'offer' => $this->get_offer(),
            'new_price' => $this->get_new_price(),
            'colors' => $this->get_color(),
            'is_wishlist' => $this->is_wishlist_to_user()
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
        $sizeProduct = $this->sizes;
        return SizeResource::collection($sizeProduct);
    }
    public function get_color()
    {
        $colorProduct = $this->colors;
        return ColorResource::collection($colorProduct);
    }
    public function get_offer()
    {
        $OfferProduct =  $this->offer;
        return $OfferProduct->value;
    }
    public function get_new_price()
    {if ($this->offer) {
        $offer=$this->offer;
          $valueOffer=$offer->value;
          $price=$this->price;
          $oldPrice=$price-$valueOffer*$price;
        return $oldPrice;
    }else{
        return $this->price;
    }

    }
}

