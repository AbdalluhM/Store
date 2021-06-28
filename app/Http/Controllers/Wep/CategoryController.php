<?php

namespace App\Http\Controllers\Wep;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        // dd($categories);
        return view('categories.index')->with('categories',$categories);
    }

    public function create(){
        $supCategory=Category::where('parent_id','!=','null')->get();
        // dd($supCategory);
        return view('categories.add')->with('supCategories',$supCategory);
    }

    public function store(CategoryRequest $request){
        if (request()->has('parent_id')) {
            # code...
        }

        $image=$request->category_image->store('images/categories');
        Category::create(array_merge($request->all(),['category_image'=>$image]));
        return redirect(route('index_category'));

    }
    public function edit(Category $category){
        // dd($category);

        $supCategory=Category::where('parent_id','!=','null')->get();
        return view('categories.update')->with(['category'=>$category,'supCategories'=>$supCategory]) ;
    }
    public function update(CategoryRequest $request,Category $category){
        if (request()->hasFile('image')) {
            $image=$request->category_image->store('images/categories');
            $category->update(array_merge($request->all(),['category_image'=>$image]));
        }
        else{
            $category->update($request->all());
        }

        return "category update successfully " ;
    }
    public function destroy(Category $category){
        $category->delete();
        return redirect(route('index_category'));
        }
}
