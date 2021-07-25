<?php

namespace App\Http\Controllers;

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
        return view('dashboard.dashboard')->with([
            'newProduct'=>$newProduct,
            'popularProduct'=>$popularProduct
        ]);
    }
}
