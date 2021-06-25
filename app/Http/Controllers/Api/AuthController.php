<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Social;
use Illuminate\Http\Request;
use Symfony\Component\Mime\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\SocialRequest;
use App\Http\Requests\UserRequest;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Type\Exception;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use GeneralTrait;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'loginSocial']]);
    }



    /**
     * Get a JWT via given credentials.
     */
    public function login(Request $request)
    {
        $req = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|string|min:5',
        ]);
        try {
            if ($req->fails()) {
                return response()->json($req->errors(), 422);
            }
            $validByphone = ['phone' => $request->email, 'password' => $request->password];
            $token = Auth::attempt($req->validated());
            if (!$token) {
                $token = Auth::attempt($validByphone);
            }

            if (!$token) {
                return response()->json(['Auth error' => 'Unauthorized'], 401);
            }
            return $this->generateToken($token);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    // public function loginMobile(Request $request){
    // 	$req = Validator::make($request->all(), [
    //         'phone' => 'required|string',
    //         'password' => 'required|string|min:5',
    //     ]);

    //     try {
    //         if ($req->fails()) {
    //             return response()->json($req->errors(), 422);
    //         }

    //         if (! $token =Auth::attempt($req->validated())) {
    //             return response()->json(['Auth error' => 'Unauthorized'], 401);
    //         }

    //         return $this->generateToken($token);
    //     } catch (\Throwable $th) {
    //         return $th->getMessage();
    //     }

    // }
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
            $token = Auth::login($user);
            return $this->returnSuccessMessage($this->generateToken($token), 200);
        } catch (\Throwable $th) {
            return $this->returnError(500, $th->getMessage());
        }
    }

    /**
     * Sign up.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {
            $req = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'phone' => 'required|string|unique:users',
                'image' => 'image|mimes:png,jpg',
                'password' => 'required|string|confirmed|min:6|',
            ]);
            if ($req->fails()) {
                return response()->json($req->errors(), 422);
            }

            if (request()->hasFile('image')) {
                $image = $request->image->store('images/users');
                User::create(array_merge(
                    $request->all(),
                    ['password' => bcrypt($request->password), 'image' => $image]
                ));
            } else {
                User::create($request->all());
            }
            return response()->json([
                'status' => 'true',
                'errnum' => 200,
                'msg' => 'sign up'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>'false',
                'msg'=>$th->getMessage()
            ]);
            }
    }


    /**
     * Sign out
     */
    public function signout()
    {
        Auth::logout();
        return $this->returnSuccessMessage('User loged out', 200);
    }

    /**
     * Token refresh
     */
    public function refresh()
    {
        return $this->returnData('token', $this->generateToken(Auth::refresh()), 'done');
    }

    /**
     * User
     */
    public function user()
    {
        return $this->returnData('user', Auth::user(), 'done');
    }

    /**
     * Generate token
     */
    protected function generateToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => Auth::user()
        ]);
    }
    public function forgot_password(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject($this->getEmailSubject());
                });
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return Response::json(array("status" => 200, "message" => trans($response), "data" => array()));
                    case Password::INVALID_USER:
                        return Response::json(array("status" => 400, "message" => trans($response), "data" => array()));
                }
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        return Response::json($arr);
    }
    public function change_password(Request $request)
    {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
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
