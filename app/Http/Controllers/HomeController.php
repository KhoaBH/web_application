<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function Cart(){
        // Đếm số lượng sản phẩm trong giỏ hàng của người dùng hiện tại
        $cartCount = Cart::where('user_id', Auth::user()->id)->count();

        // Join bảng Cart với bảng Product để lấy thông tin sản phẩm
        $products = DB::table('carts') // Bảng Cart
        ->join('products', 'carts.product_id', '=', 'products.id') // Join với bảng Product
        ->where('carts.user_id', Auth::user()->id) // Chỉ lấy sản phẩm của người dùng hiện tại
        ->select('carts.*',
            'products.name',
            'products.price',
            'products.image',
            'products.quantity',
            DB::raw('FORMAT(products.price * 0.95, 2) as discounted_price')) // Thêm cột giá sau giảm
        ->get();

        // Kiểm tra dữ liệu

        // Trả về view với dữ liệu
        return view('home.cart', compact('products', 'cartCount'));
    }
    public function addToCart(Request $request)
    {

        $productId = $request->product_id;
        $userId = Auth::user()->id; // Lấy user_id của người dùng đăng nhập
        $cartCount = Cart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->count();
        if($cartCount==1){
            return response()->json(['message' => 'Product already in cart!'], 400);
        }
        // Tiến hành thêm sản phẩm vào giỏ hàng, ví dụ:
        $cart = new Cart();
        $cart->user_id = $userId;
        $cart->product_id = $productId;
        $cart->save();

        // Trả về phản hồi (response) thành công
        return response()->json(['message' => 'Product added to cart'], 200);
    }
    function showSellerRegisterForm(){
        return view('home.seller_register');
    }
    function registerSeller(Request $request){
        $seller = new Seller();
        $seller->business_name = $request->name;
        $seller->email = $request->email;
        $seller->phone = $request->phone;
        $seller->address = $request->address;
        $seller->description = $request->description;
        $seller->user_id = Auth::user()->id;

        $user = User::find(Auth::user()->id);
        $user->user_type="Seller";
        toastr()->addSuccess('Congratulations! Your registration as a seller on PrimePicks has been successful!!!');
        $user->save();
        $seller->save();
        return redirect('/dashboard');
    }
    function home(){
        $cartCount = Cart::where('user_id', 1)->count();

        $products = Product::orderBy('created_at', 'desc')->take(8)->get();
        return view('home.index',compact('products','cartCount'));
    }
    function view_product_detail($id){
        $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        $product = Product::find($id);
        $products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id) // Loại bỏ sản phẩm có $id
            ->take(8)
            ->get();
        return view('home.product_detail',compact('product','products','cartCount'));
    }

    function logout(){
        Auth::logout(); // Đăng xuất người dùng
        return redirect()->intended(route('home')); // Chuyển hướng về trang home
    }
}
