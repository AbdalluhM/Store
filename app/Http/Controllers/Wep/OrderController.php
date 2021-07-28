<?php

namespace App\Http\Controllers\Wep;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders=Order::paginate(4);
        return view('orders.index')->with('orders',$orders);
    }

    public function order_details($id){
        $order=order::find($id);
        $order_details=OrderDetails::where('order_id',$order->id)->paginate(4);
        return view('orders.details')->with('order_details',$order_details);
      }
}
