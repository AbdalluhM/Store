<?php

namespace App\Http\Controllers\Wep;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index', 'store', 'sub_category']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $categories =  Category::whereNull('parent_id')->get();
        return view('categories.index')->with('categories', $categories);
    }

    public function createCategory()
    {
        // $categories = Category::whereNull('parent_id')->get();
        return view('categories.add');
    }

    public function createSupCategory()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('categories.add')->with('categories', $categories);
    }

    public function store(CategoryRequest $request)
    {
        $image = time() . '_' . $request->file('category_image')->hashName();
        $request->file('category_image')->storeAs('public/images/categories/', $image);
        Category::create(array_merge($request->all(), ['category_image' => $image]));
        session()->flash('success', 'category created successfully');
        return redirect()->back();
    }
    public function edit(Category $category)
    {
        return view('categories.update')->with(['category' => $category]);
    }

    public function edit_sup_category($id)
    {
        $supCategory = Category::find($id);
        $categories = Category::whereNull('parent_id')->get();
        $category = Category::where('id', $supCategory->parent_id)->first();
        // dd($category);
        return view('categories.update')->with([
            'categories' => $categories,
            'supCategory' => $supCategory,
            'category'=> $category
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        if (request()->hasFile('category_image')) {

            Storage::disk('public')->delete('/images/categories/' . $category->category_image);
            $image = time() . '_' . $request->file('category_image')->hashName();
            $request->file('category_image')->storeAs('public/images/categories/', $image);
            $category->update(array_merge($request->all(), ['category_image' => $image]));
            session()->flash('success', 'Category Updated Successfully');
        }

        return redirect()->route('categories.index');
    }
    public function update_sup_category(CategoryRequest $request,  $id)
    {
        if (request()->hasFile('category_image')) {
           $supCategory=Category::find($id);
            Storage::disk('public')->delete('/images/categories/' . $supCategory->category_image);
            $image = time() . '_' . $request->file('category_image')->hashName();
            // dd($request->all());
            $request->file('category_image')->storeAs('public/images/categories/', $image);
            $supCategory->update(array_merge($request->all(), ['category_image' => $image]));
            session()->flash('success', 'Sup Category Updated Successfully');
        }

        return redirect()->route('index_sub_category');
    }
    public function destroy(Category $category)
    {
        Storage::disk('public')->delete('/images/categories/' . $category->category_image);
        $sup = Category::where('parent_id', $category->id);
        $sup->delete();
        $category->delete();
        session()->flash('success', 'Category Deleted Successfully');
        return redirect(route('categories.index'));
    }

    public function sub_category()
    {
        $supCategory = Category::whereNotNull('parent_id')->get();
        return view('categories.index2')->with('supCategory', $supCategory);
    }
}
