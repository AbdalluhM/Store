<?php

use Illuminate\Support\Facades\Route;
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


Route::get('dashboard', function () {
       return view('dashboard.dashboard');
});

Route::get('category',[CategoryController::class,('index')])->name('index_category');
Route::get('create',[CategoryController::class,('create')])->name('create_category');
Route::post('store',[CategoryController::class,('store')])->name('store_category');
Route::get('category/{category}/edit',[CategoryController::class,('edit')])->name('edit_category');
Route::post('update/{category}',[CategoryController::class,('update')])->name('update_category');
Route::post('category/{category}/delete',[CategoryController::class,('destroy')])->name('category_delete');


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
    });


