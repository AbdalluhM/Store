<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCartResource extends JsonResource
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
            'desc' => $this->description,
            'image' => $this->image,
            'price' => $this->price,
            // 'offer' => $this->get_new_price(),
            // 'new_price' => $this->new_price(),
            // 'discount'=>$this->get_discount(),
        ];
    }
    public function get_offer()
    {
        $OfferProduct =  $this->offer;
        return $OfferProduct->value;
    }
    public function get_new_price()
    {
        if ($this->offer) {
            $offer = $this->offer;
            $valueOffer = $offer->value;
            $price = $this->price;
            $newprice = $price - $valueOffer * $price;
            return $newprice;
        } else {
            return $this->price;
        }
    }
    public function get_discount()
    {
        if ($this->offer) {
            $offer = $this->offer;
            $valueOffer = $offer->value;
            $price = $this->price;
            $discount =  $valueOffer * $price;
            return $discount;
        }
    }
}
