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

class HomeController extends Controller
{
    const PER_PAGE = 4;
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
        $offers = Product::whereHas('offer')->paginate(self::PER_PAGE);
        try {
            if ($offers->count()==0) {
                return $this->returnError(400,'noting product has offer');
            }
            return $this->returnData('offers', OfferResource::collection($offers), "");
        } catch (\Throwable $th) {
            return $this->returnError(500,$th->getMessage());
        }
    }

    public function populars()
    {
      try {
        $products = Product::orderBy('order_count','DESC')->paginate(self::PER_PAGE,['name_product','price']);
        return $this->returnData('popular_product',$products , "");
      } catch (\Throwable $th) {
          return $this->returnError(500,$th->getMessage());
      }
    }
    public function newProduct(){
       try {
        $products = Product::orderBy('id','DESC')->paginate(self::PER_PAGE,['name_product','price']);
        return $this->returnData('new_products',$products, "");
       } catch (\Throwable $th) {
          return $this->returnError(500,$th->getMessage());
       }

    }

    public function recommend(){
        try {
            $products = Product::where('recomend',1)->paginate(self::PER_PAGE,['name_product','price']);
            // dd($products);
     return $this->returnData('recomended_product', $products, "");
    } catch (\Throwable $th) {
        return $this->returnError(500,$th->getMessage());
    }
    }
}
