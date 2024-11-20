<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckUserRole;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/', [HomeController::class,'home'])->name('home');
Route::get('/logout', [HomeController::class,'logout'])->name('logout');


Route::get('/home', function () {
    return view('home.index');
})->name('home');


Route::get('/dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard')->middleware([CheckUserRole::class]);

Route::get('/add_category', function () {
    return view('admin.category');
})->name('admin.category')->middleware([CheckUserRole::class]);
Route::get('/category', [AdminController::class,'add_category_view'])->name('admin.category')->middleware([CheckUserRole::class]);
Route::post('/category', [AdminController::class,'add_category'])->name('add_category.post')->middleware([CheckUserRole::class]);
Route::get('/delete_category/{id}', [AdminController::class, 'delete_category'])->name('admin.delete_category')->middleware([CheckUserRole::class]);
Route::get('/edit_category/{data}', [AdminController::class, 'edit_category'])->name('admin.edit_category')->middleware([CheckUserRole::class]);
Route::get('/add_product', [AdminController::class, 'add_product_view'])->name('admin.product')->middleware([CheckUserRole::class]);
Route::post('/add_product', [AdminController::class, 'add_product'])->name('add_product.post')->middleware([CheckUserRole::class]);
Route::get('/view_product', [AdminController::class, 'view_product'])->name('admin.product')->middleware([CheckUserRole::class]);
Route::get('/selected_category', [AdminController::class, 'selected_category'])->name('admin.selected_category')->middleware([CheckUserRole::class]);
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product'])->name('admin.delete_product')->middleware([CheckUserRole::class]);
Route::post('/edit_product', [AdminController::class, 'editProduct'])->name('admin.edit_product')->middleware([CheckUserRole::class]);


require __DIR__.'/auth.php';
