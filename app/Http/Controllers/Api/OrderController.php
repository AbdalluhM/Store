<?php

namespace App\Http\Controllers\Api;

use App\Models\cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use GeneralTrait;
    public function index(){
        $user=Auth::user();
        $user_id=$user->id;
        try {
            $orders=Order::where('user_id',$user_id)->get();
            return $this->returnData('orders',$orders,"");
        } catch (\Throwable $th) {
            return $this->returnError(500,$th->getMessage());
        }
    }

    public  function store(OrderRequest $request)
    {
        // $user_id=$user->id;
        // Order::create(array_merge($request->all(),['user_id'=>$user_id]));
        // return $this->returnSuccessMessage('done',5000);
        // $cart =$request->cart;
        // foreach ($cart as $value) {
            // //     $cartItem = json_decode($value,true);
            // //     dd($cartItem);

            // // }
            // $totalPrice=cart::sum('total_price');
            // dd($user);
            // DB::beginTransaction () ;
            $user=Auth::user();
            $carts=cart::where('user_id',$user->id)->get();
            if ( $carts->count() !== 0) {
            // db transaction
                try {
                    $order= Order::create([
                        'user_id'=>$user->id,
                        'address_id'=>$request->address_id,
                        'status'=>'complete',
                        'total_price'=>0,
                    ]);
                    // dd($order);
                    $total=0;

                  foreach ($carts as $cart) {

                      $product=Product::where('id',$cart->product_id)->first();
                      $price=$product->price;
                      $offer=$product->offer->value;
                    //   dd($offer);
                    $orderDetails= OrderDetails::create([
                        'product_id'=>$cart->product_id,
                        'order_id'=>$order->id,
                        'qty'=>$cart->qty,
                        'discount'=>(double)$offer*$price*$cart->qty,
                    ]);
                    $total+=$orderDetails['qty']*$price-$orderDetails['discount'];
                    $product->qty-=$cart->qty;
                    // if ($product->sell==0) {
                        $product->sell_date=Carbon::now();
                    // }
                    $product->save();
                  }
                  $order['total_price']=$total;
                  $order['status']='completed';
                  $order->save();
                  DB::table('carts')->delete();
                  return $this->returnSuccessMessage('order create successfully',200);
                   } catch (\Throwable $th) {
                    return $this->returnError(500,$th->getMessage());
                   }
                //    DB::rollback();
                }
                else{
                    return $this->returnError(400,"cart must be full");
                }
            }
}
