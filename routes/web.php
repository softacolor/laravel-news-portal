<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\SubcategoryController;

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
Route::get('/edit/category/{id}',[CategoryController::class,'edit_category'])->name('edit.category');
Route::post('/update/category/{id}',[CategoryController::class,'update_category'])->name('update.category');
Route::get('/delete/category/{id}',[CategoryController::class,'delete_category'])->name('delete.category');


// Admin subcategory

Route::get('/subcategories',[SubcategoryController::class,'index'])->name('subcategories');
Route::get('/add/subcategory',[SubcategoryController::class,'add_subcategory'])->name('add.subcategory');
Route::post('/store/subcategory',[SubcategoryController::class,'store_subcategory'])->name('store.subcategory');
Route::get('/edit/subcategory/{id}',[SubcategoryController::class,'edit_subcategory'])->name('edit.subcategory');
Route::post('/update/subcategory/{id}',[SubcategoryController::class,'update_subcategory'])->name('update.subcategory');
Route::get('/delete/subcategory/{id}',[SubcategoryController::class,'delete_subcategory'])->name('delete.subcategory');

