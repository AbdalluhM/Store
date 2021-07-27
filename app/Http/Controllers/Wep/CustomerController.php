<?php

namespace App\Http\Controllers\Wep;

use App\Http\Controllers\Controller;
use App\Models\address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $users=User::paginate(4);
        return view('cusstomers.index')->with('users',$users);
    }

    public function customer_details($id){
      $customer=User::find($id);
      $address=address::where('user_id',$customer->id)->first();
      $orders=Order::where('user_id',$customer->id)->get();
      return view('cusstomers.details')->with('customer',$customer)->with('address',$address)->with('orders',$orders);
    }
}
