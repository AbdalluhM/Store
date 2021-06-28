<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;

class AuthController extends BaseController
{
// login user
    public function signin(Request $request)
    {
        $req = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|string|min:5',
        ]);
        if ($req->fails()) {
            return $this->sendError("validation error", ["errors" => $req->errors()]);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken;
            $success['name'] =  $authUser->name;

            return $this->sendResponse($success, 'User signed in');
        } elseif (Auth::attempt(['phone' => $request->email, 'password' => $request->password])) {
            $authUser = Auth::user();
            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken;
            $success['name'] =  $authUser->name;

            return $this->sendResponse($success, 'User signed in');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
// register
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'phone' => 'required|string|unique:users',
            'image' => 'image|mimes:png,jpg',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Error validation', $validator->errors());
        }

        if (request()->hasFile('image')) {
            $input = $request->all();
            $image = $request->image->store('images/users');
            $input['image'] = $image;
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
        }else{

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        }
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User created successfully.');
    }
    // login social
    
}
