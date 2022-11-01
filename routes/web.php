<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Livewire\Admin\Brand\Index;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Brand;

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

Auth::routes();

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

   
});