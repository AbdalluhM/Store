<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'offer'=>$this->get_offer,
            'image'=>$this->product_image_path,
            'product_id'=>$this->id
            // one colum in relation
            // 'images'=>$this->products->product_image_path->first(),
        ];
    }
    public function get_offer()
    {
        if ($this->offer) {
            $OfferProduct =  $this->offer;
            return [
                'id'=>$OfferProduct->id,
                'value'=>$OfferProduct->value,
            ];
        }
        return "null";
    }

}
