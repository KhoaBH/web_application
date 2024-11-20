<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    function home(){
        $products = Product::orderBy('created_at', 'desc')->take(8)->get();
        return view('home.index',compact('products'));
    }
    function view_product_detail($id){
        $product = Product::find($id);
        $products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id) // Loại bỏ sản phẩm có $id
            ->take(8)
            ->get();
        return view('home.product_detail',compact('product','products'));
    }

    function logout(){
        Auth::logout(); // Đăng xuất người dùng
        return redirect()->intended(route('home')); // Chuyển hướng về trang home
    }
}
