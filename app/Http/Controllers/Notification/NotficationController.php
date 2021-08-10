<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class NotficationController extends Controller
{

    public function index(){
        // return view('home');
        $user  = auth()->user();
        $this->sendNotification1('order is created','your order is created',[$user->device_token]);
    }

    public function saveToken(Request $request)
    {
        auth()->user()->update(['device_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendNotification(Request $request)
    {
        $firebaseToken = Admin::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = 'AAAA7i3dDwI:APA91bGbjzWtE0qNOiyzG1cm6_30R9MvQrMqTGY-lPp5puRr-iaQ_8s-6FX3PoXuAMe3qvQ3eXW3jBYJ2cS9yNgXJWJGDTej9Lp2hgextJrj4XR1rzXbSWyBcFvksbDxcOnVZh04BfLT';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body,
                "sound"=>"defalult",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        dd($response);
    }

    public function sendNotification1(string $title , string $body , array $deviceTokens)
    {
        $SERVER_API_KEY = 'AAAA7i3dDwI:APA91bGbjzWtE0qNOiyzG1cm6_30R9MvQrMqTGY-lPp5puRr-iaQ_8s-6FX3PoXuAMe3qvQ3eXW3jBYJ2cS9yNgXJWJGDTej9Lp2hgextJrj4XR1rzXbSWyBcFvksbDxcOnVZh04BfLT';

        $data = [
            "registration_ids" => $deviceTokens,
            "notification" => [
                "title" => $title,
                "body" => $body,
                "sound"=>"defalult",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        dd($response);
    }
}
