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
Route::get('/test', function () {
    return view('test');
});



Route::get('/', function () { return redirect('/home'); });

Route::get('/home', [HomeController::class,'home'])->name('home');
Route::get('/logout', [HomeController::class,'logout'])->name('logout');
Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');

Route::get('/add_category', function () {
    return view('admin.category');
})->name('admin.category')->middleware([CheckUserRole::class]);
Route::get('/category_view', [AdminController::class,'add_category_view'])->name('admin.category')->middleware([CheckUserRole::class]);
Route::post('/category', [AdminController::class,'add_category'])->name('add_category.post')->middleware([CheckUserRole::class]);


Route::get('/sub_category', [AdminController::class,'sub_category_view'])->name('admin.sub_category')->middleware([CheckUserRole::class]);
Route::get('/add_sub_category/{data}', [AdminController::class,'add_sub_category'])->name('admin.add_sub_category')->middleware([CheckUserRole::class]);
Route::get('/sub_category_delete/{id}', [AdminController::class,'sub_category_delete'])->name('admin.sub_category_delete')->middleware([CheckUserRole::class]);
Route::get('/sub_category_edit/{data}', [AdminController::class,'sub_category_edit'])->name('admin.sub_category_edit')->middleware([CheckUserRole::class]);


Route::get('/delete_category/{id}', [AdminController::class, 'delete_category'])->name('admin.delete_category')->middleware([CheckUserRole::class]);
Route::get('/edit_category/{data}', [AdminController::class, 'edit_category'])->name('admin.edit_category')->middleware([CheckUserRole::class]);




Route::get('/add_product', [AdminController::class, 'add_product_view'])->name('admin.product')->middleware([CheckUserRole::class]);
Route::post('/add_product', [AdminController::class, 'add_product'])->name('add_product.post')->middleware([CheckUserRole::class]);
Route::get('/view_product', [AdminController::class, 'view_product'])->name('admin.product')->middleware([CheckUserRole::class]);
Route::get('/selected_category', [AdminController::class, 'selected_category'])->name('admin.selected_category')->middleware([CheckUserRole::class]);






Route::get('/delete_product/{id}', [AdminController::class, 'delete_product'])->name('admin.delete_product')->middleware([CheckUserRole::class]);
Route::post('/edit_product', [AdminController::class, 'editProduct'])->name('admin.edit_product')->middleware([CheckUserRole::class]);
Route::get('/product_detail/{id}', [HomeController::class, 'view_product_detail'])->name('home.product');



//seller
Route::get('/seller_register', [HomeController::class, 'showSellerRegisterForm']);
Route::post('/seller_register', [HomeController::class, 'registerSeller'])->name('seller_register.post');
//cart
Route::post('/add-to-cart', [HomeController::class, 'addToCart']);
Route::get('/cart', [HomeController::class,'Cart'])->name('Cart');
Route::post('/remove-from-cart', [HomeController::class, 'removeFromCart']);
Route::post('/checkout', [HomeController::class,'checkout'])->name('checkout');
//profile
Route::get('/profile', [HomeController::class,'profile'])->name('profile');
Route::post('/confirm', [HomeController::class,'confirm_delivery'])->name('confirm_delivery');
//shop
Route::get('/products123', [HomeController::class,'showAllProducts'])->name('products');
Route::get('/ordersConfirmation', [AdminController::class,'ordersConfirmation_view'])->name('ordersConfirmation.view');

Route::post('/ordersConfirmation', [AdminController::class,'ordersConfirmation'])->name('ordersConfirmation');
Route::get('/search_products', [HomeController::class, 'search_products'])->name('search_products');
Route::post('/restock', [AdminController::class,'restock'])->name('restock');

require __DIR__.'/auth.php';
