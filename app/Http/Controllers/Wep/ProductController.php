<?php

namespace App\Http\Controllers\Wep;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\offer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;

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
        $products = Product::all();
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
        return view('offers.create')->with([
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

        $image = time() . '_' . $request->file('image')->hashName();
        $request->file('image')->storeAs('public/images/products/', $image);
        $product = Product::create(array_merge($request->all(), ['image' => $image]));
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
        $products = product::all();
        return view('Products.update')->with([
            'product' => $product,
            'categories' => $categories,
            'products' => $products,
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
        if (request()->hasFile('image')) {
            Storage::disk('public')->delete('/images/products/' . $product->image);
            $image = time() . '_' . $request->file('image')->hashName();
            $request->file('image')->storeAs('public/images/products/', $image);
            $product->update(array_merge($request->all(), ['image' => $image]));
            $product->sizes()->sync($request->sizes);

        }
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
}
