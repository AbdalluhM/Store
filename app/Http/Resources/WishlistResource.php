<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WishlistResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->collection([]),
            'image'=>$this->image,
            'price'=>$this->price,
            'size'=>$this->sizes,
            'color'=>$this->colors,
            'is_wishlist' => $this->is_wishlist_to_user()
        ];
    }
}
