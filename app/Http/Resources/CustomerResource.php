<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'customer'=>$this->customer_name,
            'mobile'=>$this->phone ,
            'email'=>$this->email,
            'address'=>$this->address,
            'contact_name'=>$this->contact_name,
        ];
    }
}
