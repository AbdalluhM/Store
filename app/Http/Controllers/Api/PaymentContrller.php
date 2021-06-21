<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class PaymentContrller extends Controller
{
    use GeneralTrait;
    public function store(PaymentRequest $requst){
        $user=auth()->user();
        Payment::create(array_merge($requst->all(),['user_id'=>$user->id]));
        return $this->returnSuccessMessage('done',5000);
    }
}
