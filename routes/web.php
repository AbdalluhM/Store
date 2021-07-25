<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Wep\SizeController;
use App\Http\Controllers\Wep\ColorController;
use App\Http\Controllers\Wep\OfferController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\RoleController;
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


            Route::resource('products', ProductController::class)->middleware('CheckSupCategory');
            Route::get('product/update/{product}/quantity', [ProductController::class,('add_quantity')])->name('products.qty');
            Route::post('product/update/{product}/quantity', [ProductController::class,('store_quantity')])->name('products.qty.update');;
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
        Route::get('category/search',[CategoryController::class, ('search')] )->name('categories.search');
        Route::get('category', [CategoryController::class, ('index')])->name('categories.index');
        Route::get('sup/category', [CategoryController::class, ('sub_category')])->name('index_sub_category')->middleware('checkcategory');
        Route::get('create/category', [CategoryController::class, ('createCategory')])->name('create_category');
        Route::get('create/supcategory', [CategoryController::class, ('createSupCategory')])->name('create_sup_category');
        Route::post('store', [CategoryController::class, ('store')])->name('store_category');
        Route::get('category/{category}/edit', [CategoryController::class, ('edit')])->name('edit_category');
        Route::get('supcategory/{category}/edit', [CategoryController::class, ('edit_sup_category')])->name('supcategories.edit');
        Route::post('update/{category}', [CategoryController::class, ('update')])->name('categories.update');
        Route::post('update/{category}/supcategory', [CategoryController::class, ('update_sup_category')])->name('supcategories.update');
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


// roles...permission...admin
Route::group(['middleware' => ['auth:admin']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', AdminController::class);
    Route::get('permission',[ PermissionController::class,('index')])->name('permission.index');
});

