<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
})->name('admin.dashboard');

Route::get('/add_category', function () {
    return view('admin.category');
})->name('admin.category');
Route::get('/add_category', [AdminController::class,'add_category_view'])->name('admin.category');
Route::post('/add_category', [AdminController::class,'add_category'])->name('add_category.post');

require __DIR__.'/auth.php';
