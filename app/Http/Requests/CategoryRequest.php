<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_name'=>'required|unique:categories',
            'category_image'=>'required|image|mimes:jpg,png'
        ];
    }
    public function messages()
    {
        return[
            'category_name.required'=>'يجب عليك ادخال الصنف ',
            'category_image.mimes'=>'jpg , png يجب ان يكون نوع الصوره ',
            'category_image.required'=>'يجب ارفاق صورة للصنف'
        ];
    }
}
