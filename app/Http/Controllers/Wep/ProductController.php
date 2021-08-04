<?php

namespace App\Http\Controllers\Wep;

use App\Models\Size;
use App\Models\Color;
use App\Models\offer;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','store']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $products = Product::paginate(4);
        return view('Products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNotNull('parent_id')->get();
        $sizes = Size::all();
        $offers = offer::all();
        return view('products.create')->with([
            'categories' => $categories,
            'offers' => $offers,
            'sizes' => $sizes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $input=$request->all();
        // dd($input);
        if (request()->hasFile('image')) {
        $image = time() . '_' . $request->file('image')->hashName();
        $request->file('image')->storeAs('public/images/products/', $image);
        $input['image']=$image;
        }
        $product = Product::create($input);
        if ($request->sizes) {
            $product->sizes()->attach($request->sizes);
        }
        session()->flash('success','Product Created Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::whereNotNull('parent_id')->get();
        $sizes = Size::all();
        $offers = offer::all();
        return view('Products.update')->with([
            'product' => $product,
            'categories' => $categories,
            'offers' => $offers,
            'sizes' => $sizes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $input=$request->all();
        if (request()->hasFile('image')) {
            Storage::disk('public')->delete('/images/products/' . $product->image);
            $image = time() . '_' . $request->file('image')->hashName();
            $request->file('image')->storeAs('public/images/products/', $image);
            $input['image']=$image;
        }
        $product->update( $input);
        $product->sizes()->sync($request->sizes);
        session()->flash('success','Product Updated Successfully');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete('/images/products/' . $product->image);
        $product->delete();
        session()->flash('success','Product Deleted Successfully');
        return redirect()->back();
    }
    public function add_quantity(Product $product){
       return view('Products.createQty')->with('product',$product);
    }
    public function store_quantity(Product $product,Request $request){
        $request->validate([
            'qty' => 'required|integer',
        ]);
        $product->qty=$product->qty+$request->qty;
        $product->save();
        return redirect()->route('products.index');
    }
}
