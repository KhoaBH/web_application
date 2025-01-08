<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function search_products(Request $request) {
        $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        $search = $request->search;

        // Limit the results to 8 products
        $products = Product::join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->where('products.name', 'LIKE', '%' . $search . '%')
            ->select('products.*', 'sellers.business_name') // Lấy tất cả các trường của sản phẩm và thêm business_name
            ->paginate(8);
        foreach ($products as $product) {
            $product->discounted_price = $product->price * 0.95;
        }
        return view('home.our_product', compact('cartCount', 'products'));
    }

    public function showAllProducts(){
        $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        $products = Product::join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->select('products.*', 'sellers.business_name') // Lấy tất cả các trường của sản phẩm và thêm business_name
            ->paginate(8); // Sửa dấu '->' thành '::' khi gọi phương thức static
        foreach ($products as $product) {
            $product->discounted_price = $product->price * 0.95;
        }
        return view('home.our_product', compact('cartCount', 'products')); // Trả dữ liệu về view
    }

    public function confirm_delivery(Request $request)
    {
        $order_id = $request->orderId;

        // Lấy đơn hàng và cập nhật trạng thái
        $order = Order::find($order_id);
        if ($order) {
            $order->status = "completed";
            $order->save();
        }

        // Lấy chi tiết đơn hàng
        $orderDetails = OrderDetail::where('order_id', $order_id)->get();

        foreach ($orderDetails as $orderDetail) {
            // Lấy thông tin sản phẩm
            $product = Product::find($orderDetail->product_id);

            // Kiểm tra nếu sản phẩm tồn tại
            if ($product) {
                // Lấy thông tin seller
                $seller = Seller::find($product->seller_id);
                if ($seller) {
                    // Kiểm tra nếu seller là admin (seller_id = 1)
                    if ($seller->id == 1) {
                        // Nếu seller là admin, admin nhận cả phần của seller và phần của admin
                        $seller->balance += $product->price * 0.95; // Seller (admin) nhận 80% giá trị sản phẩm
                        $admin = $seller; // Admin là seller có ID = 1
                        $seller->save(); // Cập nhật lại balance của seller (admin)
                    } else {
                        // Nếu seller không phải là admin, seller nhận 80%, admin nhận 15%
                        $seller->balance += $product->price * 0.8; // Seller nhận 80% giá trị sản phẩm
                        $seller->save(); // Cập nhật lại balance của seller

                        // Cập nhật số dư của admin (ID = 1)
                        $admin = Seller::find(1); // Admin có ID = 1
                        if ($admin) {
                            $admin->balance += $product->price * 0.15; // Admin nhận 15% giá trị sản phẩm
                            $admin->save(); // Cập nhật lại balance của admin
                        }
                    }
                }
            }
        }
        return response()->json(['status' => 'success', 'message' => 'Delivery confirmed']);
    }
    public function profile(){
        $orders_count= Order::where('user_id', Auth::user()->id)
            ->where('status', 'completed')
            ->count();
        $totalSpent = Order::where('user_id', Auth::user()->id)
            ->where('status', 'completed')
            ->sum('total');
        $cartCount = Cart::where('user_id', Auth::user()->id)->count(); // Đếm số sản phẩm trong giỏ hàng
        $orders = Order::where('user_id', Auth::user()->id)
            ->orderBy('status','desc') // Sắp xếp theo status (tăng dần)
            ->get();        return view('home.profile', compact('orders_count','cartCount', 'orders','totalSpent')); // Trả về view với dữ liệu giỏ hàng và đơn hàng
    }
    public function checkout(Request $request){
        $cartItems = $request->input('cart_items');
        $order = new Order();
        $order->user_id = Auth::user()->id;
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
        $totalDiscountedPrice = $products->sum(function($product) {
            return (float)$product->discounted_price; // Đảm bảo là số thực để tính tổng
        });
        $totalDiscountedPrice += 5;
        $order->total= $totalDiscountedPrice;
        $order->save();
        foreach ($cartItems as $item) {
            $productId = $item['product_id'];  // Lấy product_id
            $quantity = $item['quantity'];      // Lấy quantity
            $product = Product::where('id', $productId)->first();
            // Kiểm tra nếu sản phẩm tồn tại
            if ($product) {
                // Cập nhật số lượng sản phẩm sau khi đặt hàng
                $product->quantity -= $quantity;
                $product->save(); // Lưu lại sự thay đổi
                // Tạo chi tiết đơn hàng mới
                $orderDetail = new OrderDetail();
                $orderDetail->product_id = $product->id;
                $orderDetail->price = number_format($product->price, 2, '.', ''); // Giá gốc
                $orderDetail->final_price = number_format($product->price * 0.95, 2, '.', ''); // Giá sau giảm
                $orderDetail->quantity = $quantity;
                $orderDetail->order_id = $order->id; // Gán ID đơn hàng
                $orderDetail->save(); // Lưu chi tiết đơn hàng
            }
        }
        toastr()->addSuccess('Congratulations! Your order has been successfully placed!');
        Cart::where('user_id', Auth::user()->id)->delete();
    }
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
    public function removeFromCart(Request $request)
    {

        $productId = $request->product_id;
        $userId = Auth::user()->id; // Lấy user_id của người dùng đăng nhập

        DB::table('carts')
            ->where('product_id', $productId)
            ->where('user_id', $userId)
            ->delete();
        // Trả về phản hồi (response) thành công
        return response()->json(['message' => 'Product removed from cart!'], 200);
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
        $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        return view('home.seller_register',compact('cartCount'));
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
    function home() {
        $cartCount = Cart::where('user_id', 1)->count();
        $products = Product::join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->select('products.*', 'sellers.business_name') // Lấy tất cả các trường của sản phẩm và thêm business_name
            ->orderBy('products.created_at', 'desc')  // Đảm bảo gọi orderBy trước paginate()
            ->paginate(8);

        // Thêm discounted_price vào mỗi sản phẩm
        foreach ($products as $product) {
            $product->discounted_price = $product->price * 0.95;
        }

        return view('home.index', compact('products', 'cartCount'));
    }
    function view_product_detail($id){
        $cartCount = Cart::where('user_id', Auth::user()->id)->count();
        $product = Product::find($id);
        $product->discounted_price = $product->price * 0.95;
        $products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $id) // Loại bỏ sản phẩm có $id
            ->take(8)
            ->get();
        foreach ($products as $item) {
            $item->discounted_price = $item->price * 0.95;
        }
        return view('home.product_detail',compact('product','products','cartCount'));
    }

    function logout(){
        Auth::logout(); // Đăng xuất người dùng
        return redirect()->intended(route('home')); // Chuyển hướng về trang home
    }
}
