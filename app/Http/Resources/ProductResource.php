<?php

namespace App\Http\Resources;

use App\Models\WishList;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name'=>$this->name_product,
            'image'=>$this->image,
            'price'=>$this->price,
            'size'=>$this->sizes,
            'color'=>$this->colors,
            'is_wishlist' => $this->is_wishlist_to_user()
        ];
    }
    public function is_wishlist_to_user()
    {
        $user= auth()->user();
        if ($user) {
            $wishlist = WishList::where('user_id',$user->id)->where('product_id',$this->id)->first();
            if ($wishlist) {
                return 1;
            }
        }
        return 0;
    }
}
