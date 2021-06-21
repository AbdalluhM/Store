<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\state;

class StateController extends Controller
{
    use GeneralTrait;
    public function index(){

        return $this->returnData('cites',state::all(),'done');
    }
}
