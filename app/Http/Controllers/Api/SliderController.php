<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{

use GeneralTrait;
public function index(Request $request){
        $req = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
        ]);
        if ($req->fails()) {
            return $this->returnError(422,$req->errors());
        }
        try {
            $slider=Slider::where('id',$request->category_id)->get();
            return $this->returnData('slider',$slider,"done");
        } catch (\Throwable $th) {
            return $this->returnError(400,$th->getMessage());
        }
    }

}

