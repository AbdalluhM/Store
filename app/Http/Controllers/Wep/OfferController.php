<?php

namespace App\Http\Controllers\Wep;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:offer-list|offer-create|offer-edit|offer-delete', ['only' => ['index','store']]);
         $this->middleware('permission:offer-create', ['only' => ['create','store']]);
         $this->middleware('permission:offer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:offer-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $offers=offer::paginate(4);
        return view('offers.index')->with('offers',$offers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offers.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request)
    {
        offer::create($request->all());
        session()->flash('success','Offer Created Successfully');
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
    public function edit(offer $offer)
    {
        return view('offers.update')->with('offer',$offer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $request, offer $offer)
    {
       $offer->update($request->all());
       session()->flash('success','Offer Updated Successfully');
       return redirect()->route('offers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(offer $offer)
    {
        $offer->delete();
        session()->flash('success','Offer Deleted Successfully');
        return redirect()->back();
    }
}
