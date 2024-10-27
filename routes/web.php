<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|Test repo
*/

Route::get('/', [HomeController::class,'home'])->name('home');
Route::get('/logout', [HomeController::class,'logout'])->name('logout');


Route::get('/home', function () {
    return view('home.index');
})->name('home');

Route::get('admin/dashboard', function () {
    return view('admin.index');
})->middleware(['checkUserRole'])->name('admin.dashboard');
require __DIR__.'/auth.php';
