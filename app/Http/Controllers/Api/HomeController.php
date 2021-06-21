<?php

namespace App\Http\Controllers\Api;

use App\Models\offer;
use App\Models\Slider;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class HomeController extends Controller
{
    use GeneralTrait;
    public function sliders()
    {
        try {
            $sliders = Slider::select('image')->get();
            // dd($sliders);
            return $this->returnData('slider_image', $sliders, "");
        } catch (\Throwable $th) {
            return $this->returnError(500,$th->getMessage());
        }
    }

    public function offers()
    {
        $offers = offer::select('value','image','id')->get();
        try {
            return $this->returnData('offers', $offers, "");
        } catch (\Throwable $th) {
            return $this->returnError(500,$th->getMessage());
        }
    }

    public function populars()
    {
      try {
        $products = Product::where('sell',1)->orderBy('id','DESC')->get();
        return $this->returnData('popular_product',ProductResource::collection($products) , "");
      } catch (\Throwable $th) {
          return $this->returnError(500,$th->getMessage());
      }
    }
    public function newProduct(){
       try {
        $products = Product::orderBy('id','DESC')->get();
        return $this->returnData('new_products',ProductResource::collection($products), "");
       } catch (\Throwable $th) {
          return $this->returnError(500,$th->getMessage());
       }

    }

    public function recommend(){
        try {
            $products = Product::where('recomend',1)->first();
            // dd($products);
     return $this->returnData('new_products', $products, "");
    } catch (\Throwable $th) {
        return $this->returnError(500,$th->getMessage());
    }
    }
}
