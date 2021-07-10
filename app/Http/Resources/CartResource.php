<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'id'=> $this->id,
            'product' => $this->product(),
            'qty'=>$this->qty,
            'total'=>$this->total_price,

        ];
    }
    public function product(){
        return ProductDetailsResource::make($this->product);
    }
}
