<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    const PER_PAGE = 4;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $newProducts = Product::orderBy('id','DESC')->paginate(4);
        $orders=Order::all();
        $products=Product::all();
        $customers=User::all();
        $newcustomers=User::where( 'created_at', '>', Carbon::now()->subDays(10))->get();
        $popular=Product::orderBy('order_count','DESC')->paginate(4);
        $newArrival=Product::orderBy('sell_date','DESC')->paginate(4);
        return view('dashboard.dashboard')->with([
            'newProducts'=>$newProducts,
            'orders'=>$orders,
            'products'=>$products,
            'customers'=>$customers,
            'newcustomers'=>$newcustomers,
            'popular'=>$popular,
            'newArrival'=>$newArrival,
        ]);
    }
}
