<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocalController extends Controller
{
    public function setLanguage(string $language)
    {
        if (Session::has('language'))
        {
            Session::forget('language');
        }
        Session::put('language', $language);

        return redirect()->back();
    }
}
