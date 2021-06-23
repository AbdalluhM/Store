<?php

namespace App\Http\Controllers\Api;

use App\Models\address;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class addressController extends Controller
{
    use GeneralTrait ;

    public function store(AddressRequest $request){
        try {
            $user=Auth::user();
            $user_id=$user->id;
            address::create(array_merge($request->all(),['user_id'=>$user_id]));
            return response()->json($this->returnSuccessMessage("address saved successfully",200));
        } catch (\Throwable $th) {
            return $this->returnError(500,$th->getMessage()) ;
        }


       }
       public function update(AddressRequest $request,address $address){
        try {

            $address->update($request->all());
                $msg='تم التعديل بنجاح ';
                return $this->returnSuccessMessage($msg,200);
        }
         catch (ModelNotFoundException $e) {
          return $this->returnError(404,$e->getMessage());

          }
          catch(\Throwable $th){
             return $this->returnError(500,$th->getMessage());
          }
        }
}
