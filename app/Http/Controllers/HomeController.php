<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    function home(){
        return view('home.index');
    }
    function logout(){
        Auth::logout(); // Đăng xuất người dùng
        return redirect()->intended(route('home')); // Chuyển hướng về trang home
    }
}
