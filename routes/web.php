<?php

use App\Http\Controllers\Wep\CategoryController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Annotation\Route as AnnotationRoute;

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

// Route::get('/', function () {
//     return view('welcome');

Route::prefix('category')->group(function () {

    Route::get('/',[CategoryController::class,'index'])->name('index_category');
    Route::get('/create',[CategoryController::class,'create'])->name('create_category');
    Route::get('/{category}/edit',[CategoryController::class,'edit'])->name('edit_category');
    Route::post('/store',[CategoryController::class,'store'])->name('store_category');
    Route::post('/{category}/delete',[CategoryController::class,'destroy'])->name('delete_category');
    Route::post('/{category}/update',[CategoryController::class,'destroy'])->name('update_category');
});


Route::get('test', function () {
        return view('dashboard.dashboard');
});
