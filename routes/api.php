<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\StateController;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\Api\PaymentContrller;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\WishListController;
use App\Http\Controllers\Api\SupCategoryController;
use App\Http\Controllers\Api\UserProfileController;

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



// route : orders
Route::middleware('auth:sanctum')->group(function () {
    Route::post('order/store', [OrderController::class, 'store'])->name('store_order');
    Route::get('order', [OrderController::class, 'index'])->name('order');
    Route::post('cart/store', [CartController::class, 'store'])->name('carts.create');
    Route::get('carts', [CartController::class, 'index'])->name('carts.index');
});

// route:profile user
Route::middleware('auth:sanctum')->group(function () {
    Route::post('update', [UserProfileController::class, 'update'])->name('update_user');
});


// route:address
Route::middleware('auth:sanctum')->group(function () {
    Route::get('address', [AddressController::class, 'index'])->name('address');
    Route::post('address/store/', [AddressController::class, 'store'])->name('store_address');
    Route::post('address/update/{address}', [AddressController::class, 'update'])->name('update_address');
});



// route category
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('all_category');
    Route::get('/slider', [SliderController::class, 'index'])->name('slider');
});
Route::get('supCategory', [SupCategoryController::class, 'index'])->name('all_sup_category');


// route : product
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/detail', [ProductController::class, 'productDetails']);


// route : home page
Route::prefix('home')->group(function () {
    Route::get('/slider', [HomeController::class, 'sliders']);
    Route::get('/offer', [HomeController::class, 'offers']);
    Route::get('/popular', [HomeController::class, 'populars']);
    Route::get('/newProduct', [HomeController::class, 'newProduct']);
    Route::get('/recommend', [HomeController::class, 'recommend']);
});


// route : city and state
Route::get('city', [CityController::class, 'index']);
Route::get('state', [StateController::class, 'index']);


//wishlist
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/fav', [WishListController::class, 'index']);
    Route::post('/fav/store', [WishListController::class, 'store']);
});


// payment
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/payment', [PaymentContrller::class, 'store']);
});




// auth
Route::post('auth/signin', [AuthController::class, 'signin']);
Route::post('auth/signup', [AuthController::class, 'signup']);
Route::post('auth/signin/social', [AuthController::class, 'loginSocial']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/signout', [AuthController::class, 'signout']);
    Route::post('auth/change-password', [AuthController::class, 'change_password']);
});
