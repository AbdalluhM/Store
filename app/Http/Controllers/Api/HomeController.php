<?php

namespace App\Http\Controllers\Api;

use App\Models\offer;
use App\Models\Slider;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use App\Http\Resources\ProductDetailsResource;
use App\Http\Resources\ProductResource;

class HomeController extends Controller
{
    const PER_PAGE = 10;
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
        $offers = offer::paginate(self::PER_PAGE);
        try {
            return $this->returnData('offers', OfferResource::collection($offers), "");
        } catch (\Throwable $th) {
            return $this->returnError(500,$th->getMessage());
        }
    }

    public function populars()
    {
      try {
        $products = Product::orderBy('sell_date','DESC')->paginate(self::PER_PAGE);
        return $this->returnData('popular_product',ProductDetailsResource::make($products) , "");
      } catch (\Throwable $th) {
          return $this->returnError(500,$th->getMessage());
      }
    }
    public function newProduct(){
       try {
        $products = Product::orderBy('id','DESC')->paginate(self::PER_PAGE);
        return $this->returnData('new_products',ProductDetailsResource::make($products), "");
       } catch (\Throwable $th) {
          return $this->returnError(500,$th->getMessage());
       }

    }

    public function recommend(){
        try {
            $products = Product::where('recomend',1)->paginate(self::PER_PAGE);
            // dd($products);
     return $this->returnData('recomended_product',ProductDetailsResource::make($products), "");
    } catch (\Throwable $th) {
        return $this->returnError(500,$th->getMessage());
    }
    }
}
