<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\ProductController;
use App\Http\Controllers\Pages\CategoryController;
use App\Http\Controllers\Pages\IndexController;

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

// Create route for home Page
Route::get('/',[IndexController::class,'index'])->name('/');


// Create route for category Pages
Route::resource('category', CategoryController::class);
// Create route for product Pages
Route::resource('product', ProductController::class);






