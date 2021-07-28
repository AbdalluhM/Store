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
        $newProduct = Product::orderBy('id','DESC')->paginate(self::PER_PAGE);
        $popularProduct = Product::orderBy('sell_date','DESC')->paginate(self::PER_PAGE);
        $orders=Order::sum('total_price');
        $products=Product::all();
        $customers=User::all();
        $newcustomers=User::where( 'created_at', '>', Carbon::now()->subDays(10))->get();
        // $popular=Product::where('sell_data','>',Carbon::now()->subDay(10))->get();
        return view('dashboard.dashboard')->with([
            'newProduct'=>$newProduct,
            'popularProduct'=>$popularProduct,
            'orders'=>$orders,
            'products'=>$products,
            'customers'=>$customers,
            'newcustomers'=>$newcustomers
        ]);
    }
}
