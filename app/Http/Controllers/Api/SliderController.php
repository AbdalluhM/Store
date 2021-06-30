<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{


public function store(Request $request){
        $req = Validator::make($request->all(), [
            'category_id' => 'required',
        ]);
        if ($req->fails()) {
            return $this->returnError(422,$req->errors());
        }
        try {
            $slider=Slider::where('id',$request->category_id)->first();
            return $this->returnData('address',$slider,"done");
        } catch (\Throwable $th) {
            return $this->returnError(400,$th->getMessage());
        }
    }

}

