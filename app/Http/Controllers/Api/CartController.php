<?php

namespace App\Http\Controllers\Api;

use App\Models\cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $user = Auth::user();
        $carts = cart::where('user_id', $user->id)->get();
        if ( $carts->count() !== 0) {

                $total=0;
                $discount=0;
                $price=0;
                $product=0;
              foreach ($carts as $cart) {

                  $product=Product::where('id',$cart->product_id)->first();
                  $data['price']=$product->price;
                  $data['offer']=$product->offer->value;
                  $data['qty']=$cart->qty;
                  $data['discount']=$product['price']*$data['offer']*$data['qty'];
                  $total+=$data['qty']*$data['price']-$data['discount'];
                  $discount+=$data['discount'];
                  $price+=$data['price'];
                  $product+=$product;
              }

              return ['new_price'=>$total,"discount"=>$discount,'old_price'=>$price,'product'=>$product];
            }else{
                return "not yet";
            }

    }
    public function store(CartRequest $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        $totalPrice = $product->price * $request->qty;
        //    dd($totalPrice);
        $user = Auth::user();
        try {
            if ($product->qty >= $request->qty) {
                cart::create(array_merge($request->all(), ['user_id' => $user->id, 'total_price' => $totalPrice]));
                return $this->returnSuccessMessage('cart saved successfully', 200);
            }
            return $this->returnError(400, "quantity less than your request");
        } catch (\Throwable $th) {
            return $this->returnError(500, $th->getMessage());
        }
    }
}
