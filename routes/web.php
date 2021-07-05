<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Wep\CategoryController;
use App\Http\Controllers\wep\ProductController;
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

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});

// route category
Route::middleware(['auth'])->group(function () {
    Route::get('category', [CategoryController::class, ('index')])->name('index_category');
    Route::get('sup/category', [CategoryController::class, ('sub_category')])->name('index_sub_category');
    Route::get('create', [CategoryController::class, ('create')])->name('create_category');
    Route::post('store', [CategoryController::class, ('store')])->name('store_category');
    Route::get('category/{category}/edit', [CategoryController::class, ('edit')])->name('edit_category');
    Route::post('update/{category}', [CategoryController::class, ('update')])->name('update_category');
    Route::post('category/{category}/delete', [CategoryController::class, ('destroy')])->name('category_delete');
});



// route product

// Route::resource('product', [UserController::class]);



// route dashboard
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'setlocal']
    ],
    function () {

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    }
);


// Route::get('test', function () {

//     return view('dashboard.dashboard');
// });


// route auth

Auth::routes(['register' => false]);
