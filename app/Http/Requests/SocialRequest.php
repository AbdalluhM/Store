<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SocialRequest extends FormRequest
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
            'name'=>'required',
            'email' => 'required|string',
            'type_social' => 'required|string',
            'social_id' => 'required|integer',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors= $validator->errors()->first();
        throw new HttpResponseException(response()->json([
            'status'=>'false',
            'msg'=>$errors,
            'errnum'=>422], 422));
    }
}
