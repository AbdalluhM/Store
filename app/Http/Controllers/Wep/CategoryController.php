<?php

namespace App\Http\Controllers\Wep;

use App\Models\Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use GeneralTrait ;
    public function index(){
         $categories =Category::all();
        try {
            // return  $this->returnData('Categories',$categories,"");
            return $this->returnData('Categories',CategoryResource::collection($categories),"");
        } catch (\Throwable $th) {
            return $th;
        }
    }

   public function store(CategoryRequest $request){
    // $rules=[
    //     'category_name'=>'required|unique:categories',
    //     'category_image'=>'required|image|mimes:jpg,png'
    // ];
    // $message=[
    //     'category_name.required'=>'يجب عليك ادخال الصنف ',
    //     'category_image.mimes'=>'jpg , png يجب ان يكون نوع الصوره ',
    //     'category_image.required'=>'يجب ارفاق صورة للصنف'
    // ];
    // $validaator=Validator::make($request->all(),$rules,$message);
    // if($validaator->fails()){
    //     return response()->json([
    //         'status'=>'false',
    //         'msg'=>$validaator->errors()
    //     ],422);
    // }
    try {
        $image = $request->category_image->store('images',);
        // $image=Storage::disk('local')->put('image.jpg', $request->category_image);
        $data=array_merge($request->all(),['imade'=>$image]);
        Category::create($data);
        $msg='تم تسجيل الصنف بنجاح ';
        return response()->json($this->returnSuccessMessage($msg,200));
    } catch (\Throwable $th) {
        return $th->getMessage() ;
    }


   }
   public function update($id ,Request $request){
    try {
        $category=Category::findOrFail($id);
            $category->category_name=$request->category_name;
            $category->category_image=$request->category_image;
            $category->description=$request->description;
            $category->category_image=$request->category_image;
            $request->category_image->store('images',);
            $category->save();
            $msg='تم التعديل بنجاح ';
            return response()->json($this->returnSuccessMessage($msg,200));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
      return response()->json([
          'status'=>'false',
          'msg'=>'category '.$request->id.'not found',
      ]);

      }
      catch(\Throwable $th){
         return response()->json([
             'status'=>'false',
             'msg'=>$th->getMessage()
         ]);
      }
    }
    public function delete($id ,Request $request){
        try {
            $category=Category::findorfail($id);
                $category->delete();
                $msg='تم الحذف بنجاح ';
                return response()->json($this->returnSuccessMessage($msg,200));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
          return response()->json([
              'status'=>'false',
              'msg'=>'category '.$request->id.'not found',
          ]);

          }
          catch(\Throwable $th){
            return response()->json([
                'status'=>'false',
                'msg'=>$th->getMessage()
            ]);
         }
        }
}

