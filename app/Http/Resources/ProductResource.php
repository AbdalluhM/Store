<?php

namespace App\Http\Resources;

use App\Models\Size;
use App\Models\WishList;
use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\ErrorHandler\Collecting;

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
            'id' => $this->id,
            'name' => $this->name_product,
            'image' => $this->image,
            'recomend' => $this->recomend,
            'sell' => $this->sell,
            'price' => $this->price,
            'offer' => $this->get_offer(),
            'sizes' => $this->get_size(),
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
}
