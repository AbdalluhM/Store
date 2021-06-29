<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Http\Requests\SocialRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
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
        } else {

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
        }
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User created successfully.');
    }


    // login social

    public function loginSocial(SocialRequest $request)
    {

        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }
            // dd($user);
            $userSocial = Social::where('social_id', $request->social_id)
                ->where('type_social', $request->type_social)
                ->first();
            if (!$userSocial) {
                Social::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'user_id' => $user->id,
                    'social_id' => $request->social_id,
                    'type_social' => $request->type_social,
                ]);
            }
            $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
            $success['name'] =  $user->name;
            return $this->sendResponse($success, 'User signed in');
        } catch (\Throwable $th) {
            return $this->sendError("Server Error", $th->getMessage());
        }
    }

    /// log out
    public function signout()
    {
        $user = request()->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        return response()->json([
            'status' => 'true',
            'message' => 'User log out'

        ]);
    }


    // change password
    public function change_password(Request $request)
    {
        $input = $request->all();
        $userid = Auth::user()->id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                    $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
                } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                    $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }
        }
        return Response::json($arr);
    }
}
