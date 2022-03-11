<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\CategoryController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


// Admin

Route::get('/admin/logout',[AdminController::class,'logout'])->name('admin.logout');

// Admin Category Route

Route::get('/categories',[CategoryController::class,'index'])->name('categories');
Route::get('/add/category',[CategoryController::class,'add_category'])->name('add.category');
Route::post('/store/category',[CategoryController::class,'store_category'])->name('store.category');