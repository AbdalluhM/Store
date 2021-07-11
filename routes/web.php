<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Wep\SizeController;
use App\Http\Controllers\Wep\ColorController;
use App\Http\Controllers\Wep\OfferController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Wep\SliderController;
use App\Http\Controllers\Wep\ProductController;
use App\Http\Controllers\Wep\CategoryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




// route products

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin']
    ],
    function () {


            Route::resource('products', ProductController::class)->middleware('checkcategory');

    }
);

// route colors

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin']
    ],
    function () {

        Route::resource('colors', ColorController::class);


    }
);




// route offers


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin']
    ],
    function () {

        Route::resource('offers', OfferController::class);


    }
);




// route sizes


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin']
    ],
    function () {

        Route::resource('sizes', SizeController::class);


    }
);





// route sliders

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin']
    ],
    function () {

        Route::resource('sliders', SliderController::class);


    }
);





// route category

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin']
    ],
    function () {

        Route::get('category', [CategoryController::class, ('index')])->name('index_category');
        Route::get('sup/category', [CategoryController::class, ('sub_category')])->name('index_sub_category')->middleware('checkcategory');
        Route::get('create', [CategoryController::class, ('create')])->name('create_category');
        Route::post('store', [CategoryController::class, ('store')])->name('store_category');
        Route::get('category/{category}/edit', [CategoryController::class, ('edit')])->name('edit_category');
        Route::post('update/{category}', [CategoryController::class, ('update')])->name('update_category');
        Route::post('category/{category}/delete', [CategoryController::class, ('destroy')])->name('category_delete');

    }
);




// route product

// Route::resource('product', [UserController::class]);



// route dashboard
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    }
);


// Route::get('test', function () {

//     return view('dashboard.dashboard');
// });


// route auth

Auth::routes([
    'register' => false,
    'login'=>false,
]);
Route::get('login/admin', [LoginController::class, ('showLoginForm')])->name('login');
Route::post('login/admin', [LoginController::class, ('loginAdmin')])->name('login.admin');
