<?php

namespace App\Http\Controllers\Api;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDetailsResource;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use GeneralTrait ;
    public function index(Request $request){
        try {
            $validator=Validator::make($request->all(),[
                'supcategory_id'=>'required|exists:categories,id',
            ]);
            if ($validator->fails()) {
                return $this->returnError('400',$validator->errors());
            }
            $product =Product::where('category_id',$request->supcategory_id) ->get();
            return $this->returnData('products',ProductDetailsResource::collection($product),"");
        } catch (\Throwable $th) {
              return $this->returnError(500,$th->getMessage());;
        }


    }
    public function productDetails(Request $request){
        try {
            $validator=Validator::make($request->all(),[
                'product_id'=>'required|exists:products,id',
            ]);
            if ($validator->fails()) {
                return $this->returnError('400',$validator->errors());
            }
            $product =Product::where('id',$request->product_id)->get();
            return $this->returnData('products',ProductDetailsResource::collection($product),"");
        } catch (\Throwable $th) {
              return $this->returnError(500,$th->getMessage());;
        }

    }
}
