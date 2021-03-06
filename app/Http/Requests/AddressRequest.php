<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddressRequest extends FormRequest
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
            'number_house' => 'required|integer',
            'street' => 'required|string',
            'landmark' => 'required|string',
            'city_id' => 'required|integer',
            'state_id' => 'required|integer',
            'type_house' => 'required|in:home,work/office',
            'order_owner' => 'required',
            'mobile' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'number_house.required' => 'يرجي ادخال رقم المنزل',
            'street.required' => "يرجي ادخال اسم الشارع",
            'landmark.required' => "يجب ادخال علامه مميزه للمنزل",
            'city_id.required' => "يجب ادخال اسم المدينه",
            'state_id.required' => "يجب ادخال اسم الدولة ",
            'type_house.required' => " home||work/office يجب ادخال نوع المنزل ويكون من النوع",
            'type_house.in' => "home or work/office اختار بين  ",
            'order_owner.required' => "يجب ادخال اسم صاحب الطلب",
            'mobile.required' => "يجب ادخال رقم تليفون صاحب الطلب",
        ];
    }
    // protected function failedValidation(Validator $validator)
    // {
    //     $errors= $validator->errors()->first();
    //     throw new HttpResponseException(response()->json([
    //         'status'=>'false',
    //         'msg'=>$errors,
    //         'errnum'=>422], 422));
    // }
    protected function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([
            'status' => 'false',
            'errnum' => 422,
            'errors' => $validator->errors(),
        ], 422));
    }
}
