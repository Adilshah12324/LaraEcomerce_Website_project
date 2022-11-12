<?php

use App\Models\Brand;
// use App\Http\Livewire\Admin\Brand\Index;
use App\PaymentService\PaypalApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;

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
// });



Auth::routes();
Route::get('/',[FrontendController::class,'index']);
Route::get('/collections',[FrontendController::class,'categories']);
Route::get('/collections/{category_slug}',[FrontendController::class,'products']);
Route::get('/collections/{category_slug}/{product_slug}',[FrontendController::class,'productView']);

// wishlist route
Route::get('/collections-wishlist/{id}',[WishlistController::class,'wishlist']);
Route::get('/wishlist',[WishlistController::class,'index']);
Route::get('/wishlist/{id}',[WishlistController::class,'destroy']);




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('dashboard',[DashboardController::class, 'index']);
  
    // Category Routes
    Route::controller(CategoryController::class)->group(function(){
        Route::get('category', 'index');
        Route::get('category/create','create');
        Route::post('category','store');
        Route::get('category/{category}/edit','edit');
        Route::put('category/{category}','update');
        Route::get('category/{id}','delete');
    });
    
    // Brand Routes
    Route::get('/brands',App\Http\Livewire\Admin\Brand\Index::class);
    Route::controller(BrandController::class)->group(function(){
        Route::get('brand/create','create');
        Route::post('brand','store');
        Route::get('brand/{brand}/edit','edit');
        Route::put('brand/{brand}','update');
        Route::get('brand/{id}','delete');
    });

    // Product Routes
    Route::controller(ProductController::class)->group(function(){
        Route::get('product','index');
        Route::get('product/create','create');
        Route::post('product','store');
        Route::get('product/{product}/edit','edit');
        Route::put('product/{product}','update');
        Route::get('product-image/{product_image_id}/delete','destroyImage');
        Route::get('product/{id}/delete','destroy');
        Route::post('product-color/{prod_color_id}','updateProdColorQty');
    });

    // color Routes
    Route::controller(ColorController::class)->group(function(){
        Route::get('color','index');
        Route::get('color/create','create');
        Route::post('color/create','store');
        Route::get('color/{color}/edit','edit');
        Route::put('color/{color}','update');
        Route::get('color/{id}/delete','destroy');
    });

       // slider Routes
       Route::controller(SliderController::class)->group(function(){
        Route::get('slider','index');
        Route::get('slider/create','create');
        Route::post('slider/create','store');
        Route::get('slider/{slider}/edit','edit');
        Route::put('slider/{slider}','update');
        Route::get('slider/{id}/delete','destroy');
    });

   
});