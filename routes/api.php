<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\PaymentContrller;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\SupCategoryController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\Api\WishListController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// route:auth for user
Route::post('/forgot-password', [AuthController::class, 'forgot_password']);
Route::middleware('api')->prefix('auth')-> group(function ($router) {
    Route::post('/signup', [AuthController::class, 'register']);
    Route::post('/signin', [AuthController::class, 'login']);
    Route::post('/signin/social', [AuthController::class, 'loginSocial']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/token-refresh', [AuthController::class, 'refresh']);
    Route::post('/signout', [AuthController::class, 'signout']);
    Route::post('/change-password', [AuthController::class, 'change_password']);
});

// route : orders
Route::middleware('auth:api')->group(function () {
    Route::post('order/store',[OrderController::class,'store'])->name('store_order');
    Route::get('order',[OrderController::class,'index'])->name('order');
    Route::post('cart',[CartController::class,'store'])->name('cart');
});


// route:profile user
Route::middleware('auth:api')->group(function () {
    Route::post('update',[UserProfileController::class,'update'])->name('update_user');
});


// route:address
Route::middleware('auth:api')->group(function () {
    Route::post('address/store',[AddressController::class,'store'])->name('store_address');
    Route::post('address/update/{address}',[AddressController::class,'update'])->name('store_address');
});



// route category
Route::prefix('category')->group(function () {
    Route::get('/',[CategoryController::class,'index'])->name('all_category');
});
Route::get('supCategory',[SupCategoryController::class,'index'])->name('all_sup_category');


// route : product
Route::get('/product',[ProductController::class,'index']);
Route::get('/product/detail',[ProductController::class,'productDetails']);


// route : home page
Route::prefix('home')->group(function () {
    Route::get('/slider',[HomeController::class,'sliders']);
    Route::get('/offer',[HomeController::class,'offers']);
    Route::get('/popular',[HomeController::class,'populars']);
    Route::get('/newProduct',[HomeController::class,'newProduct']);
    Route::get('/recommend',[HomeController::class,'recommend']);
});


// route : city and state
Route::get('city',[CityController::class,'index']);
Route::get('state',[StateController::class,'index']);


//wishlist
Route::middleware('auth:api')->group(function () {
    Route::get('/fav',[WishListController::class,'index']);
    Route::post('/fav/store',[WishListController::class,'store']);
});


// payment
Route::middleware('auth:api')->group(function () {
    Route::post('/payment',[PaymentContrller::class,'store']);
});


