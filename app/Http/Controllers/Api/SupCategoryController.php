<?php

namespace App\Http\Controllers\Api;
use App\Models\Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class SupCategoryController extends Controller
{
    use GeneralTrait ;
    public function index(Request $request){
        $validaator=Validator::make($request->all(),[
            'parent_id'=>'required|integer|exists:categories,parent_id'
        ],
        [
          'parent_id.exists'=>'هذا الصنف لا يوجد منه اصناف فرعيه'
        ]);
        if($validaator->fails()){
             return $this->returnError(400,$validaator->errors());
        }
        try {
            $supCategory=Category::where('parent_id',$request->parent_id)->get();
            return $this->returnData('sup_categories',CategoryResource::collection($supCategory),"");
        } catch (\Throwable $th) {
            return $this->returnError(500,$th->getMessage());
        }
    }
}
