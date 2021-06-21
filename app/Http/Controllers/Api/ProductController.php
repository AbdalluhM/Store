<?php

namespace App\Http\Controllers\Api;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    use GeneralTrait ;
    public function index(){
        try {
            $product =Product::with(['offer','sizes','colors'])->get();
            return $this->returnData('products',ProductResource::collection($product),"");
        } catch (\Throwable $th) {
              return $this->returnError(500,$th->getMessage());;
        }


    }
}
