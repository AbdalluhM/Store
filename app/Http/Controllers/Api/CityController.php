<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\city;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use GeneralTrait;
    public function index(){
        
        return $this->returnData('cites',city::all(),'done');
    }
}
