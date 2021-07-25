<?php

namespace App\Http\Controllers\Wep;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $users=User::paginate(4);
        return view('cusstomers.index')->with('users',$users);
    }
}
