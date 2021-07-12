<?php

namespace App\Http\Controllers\Api;

use App\Models\WishList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistResource;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WishListController extends Controller
{
    use GeneralTrait;
    public function index(){
        try {

            $user = Auth::user();
            $wishlists = Wishlist::with('product')->where("user_id", "=", $user->id)->orderby('id', 'desc')->get();
            return $this->returnData('wishlists',WishlistResource::collection($wishlists),'') ;
        } catch (\Throwable $th) {
            return $this->returnError(500,$th->getMessage());
        }
    }
    public function store(Request $request){
        $rules=[
            'product_id'=>'required|exists:products,id',
        ];
        $validator=Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return $this->returnError(422,$validator->errors());
        }

        try {
            $user = Auth::user();
            $user_id=$user->id;
            $wishlist=WishList::where('product_id',$request->product_id)
            ->where('user_id',$user_id)->get();
            // dd($wishlist);
            if ( $wishlist->count()==0) {
                WishList::create( array_merge($request->all(),['user_id'=>$user_id]));
                return $this->returnSuccessMessage('product became fav',200);
            }else{
                WishList::where('product_id',$request->product_id)
                ->where('user_id',$user_id)->delete();
                return $this->returnSuccessMessage('product became not fav',200);
            }

        } catch (\Throwable $th) {
            return $this->returnError(400,$th->getMessage());
        }
    }
}
