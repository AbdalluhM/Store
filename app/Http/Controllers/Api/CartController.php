<?php

namespace App\Http\Controllers\Api;

use App\Models\cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use GeneralTrait;
    public function store(CartRequest $request){
       $product= Product::where('id',$request->product_id)->first();
       $totalPrice=$product->price*$product->qty;
    //    dd($product->qty);
       $user=Auth::user();
       try {
        if($product->qty>$request->qty){
            cart::create(array_merge($request->all(),['user_id'=>$user->id,'total_price'=>$totalPrice]));
            return $this->returnSuccessMessage('cart saved successfully',200) ;
        }
        return $this->returnError(400,"quantity less than your request");
       } catch (\Throwable $th) {
        return $this->returnError(500,$th->getMessage());
       }

    }
}
