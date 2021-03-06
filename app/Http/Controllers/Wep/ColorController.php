<?php

namespace App\Http\Controllers\Wep;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use Illuminate\Support\Facades\Storage;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:color-list|color-create|color-edit|color-delete', ['only' => ['index','store']]);
         $this->middleware('permission:color-create', ['only' => ['create','store']]);
         $this->middleware('permission:color-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:color-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $colors = Color::paginate(4);
        return view('colors.index')->with('colors', $colors);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('colors.add')->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorRequest $request)
    {
        $input=$request->all();
        if (request()->hasFile('image')) {
        $image = time() . '_' . $request->file('image')->hashName();
        $request->file('image')->storeAs('public/images/colors/', $image);
        $input['image']=$image;
        }
        Color::create($input);
        session()->flash('success','Color Created Successfully');
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
    public function edit(Color $color)
    {
        $products = Product::all();
        return view('colors.update')->with(['products' => $products, 'color' => $color]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ColorRequest $request, Color $color)
    {
        $input=$request->all();
        if (request()->hasFile('image')) {
            Storage::disk('public')->delete('/images/colors/' . $color->image);
            $image = time() . '_' . $request->file('image')->hashName();
            $request->file('image')->storeAs('public/images/colors/', $image);
            $input['image']=$image;
        }
        $color->update($input);
        session()->flash('success','Color Updated Successfully');


        return redirect()->route('colors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        Storage::disk('public')->delete('/images/colors/' . $color->image);
        $color->delete();
        session()->flash('success','Color Deleted Successfully');
        return redirect()->back();
    }
}
