<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Seller;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function restock(Request $request) {
        $product = Product::find($request->productId);
        if ($product) {
            $product->quantity += $request->number;
            $product->save();
            return redirect()->back();
        } else {
            return response()->json(['message' => 'Product not found.'], 404);
        }
        return redirect()->back();
    }

    public function ordersConfirmation_view(){
        $seller_id = Seller::where('user_id', Auth::user()->id)->first()->id;
        $orders = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                'order_details.id as order_detail_id',
                'order_details.quantity',
                'order_details.price',
                'order_details.status',  // Bao gồm cột status
                'order_details.created_at as order_date',
                'order_details.order_id as order_id',
                'products.name as product_name',
                'products.price as product_price',
                'products.seller_id'
            )
            ->where('products.seller_id', $seller_id)
            ->whereDate('order_details.created_at', today())  // Lọc theo ngày hôm nay
            ->orderBy('status','desc')
            ->get();
        return view('admin.ordersConfirmation',compact('orders'));
    }
    public function ordersConfirmation(Request $request) {
        // Find the specific OrderDetail by its ID
        $orderDetail = OrderDetail::find($request->orderDetailId);

        // Update the status of the found OrderDetail to "confirmed"
        $orderDetail->status = "confirmed";
        $orderDetail->save();

        // Get the order ID from the updated OrderDetail
        $orderId = $orderDetail->order_id;

        // Check if all OrderDetails for this Order have a status of "confirmed"
        $allConfirmed = OrderDetail::where('order_id', $orderId)
            ->where('status', '!=', 'confirmed')// Sắp xếp theo status (tăng dần)
            ->doesntExist();
        // If all OrderDetails are confirmed, update the Order status to "delivering"
        if ($allConfirmed) {
            $order = Order::find($orderId);
            $order->status = "delivering";
            $order->save();
        }
        return response()->json(['message' => 'OrderDetail status updated and Order status checked.']);
    }

    public function dashboard()
    {
        // Lấy seller_id của người dùng
        $seller_id = Seller::where('user_id', Auth::user()->id)->first()->id;

        // Truy vấn dữ liệu order_detail kết nối với bảng Product để lấy doanh thu và đơn hàng theo tháng
        $monthlyData = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                DB::raw('MONTH(order_details.created_at) as month'),
                DB::raw('YEAR(order_details.created_at) as year'),
                DB::raw('SUM(order_details.price * order_details.quantity) as total_revenue'),  // Doanh thu tính theo quantity
                DB::raw('SUM(order_details.quantity) as total_orders')  // Số lượng đơn hàng tính theo quantity
            )
            ->where('products.seller_id', $seller_id)  // Lọc theo seller_id của bảng Product
            ->groupBy(DB::raw('YEAR(order_details.created_at)'), DB::raw('MONTH(order_details.created_at)'))
            ->orderBy(DB::raw('YEAR(order_details.created_at)'), 'asc')
            ->orderBy(DB::raw('MONTH(order_details.created_at)'), 'asc')
            ->get();

        // Truy vấn doanh thu và số sản phẩm bán trong hôm nay
        $todayData = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                DB::raw('SUM(order_details.price * order_details.quantity) as today_revenue'),  // Doanh thu hôm nay
                DB::raw('SUM(order_details.quantity) as today_orders')  // Số lượng đơn hàng hôm nay
            )
            ->where('products.seller_id', $seller_id)
            ->whereDate('order_details.created_at', today())  // Lọc theo ngày hôm nay
            ->first();

        // Truy vấn tổng doanh thu và tổng số sản phẩm bán được
        $totalData = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(
                DB::raw('SUM(order_details.price * order_details.quantity) as total_revenue'),  // Tổng doanh thu
                DB::raw('SUM(order_details.quantity) as total_orders')  // Tổng số sản phẩm đã bán
            )
            ->where('products.seller_id', $seller_id)
            ->first();

        // Mảng chứa 12 tháng mặc định (số tháng từ 01 đến 12)
        $allMonths = array_map(function ($month) {
            return sprintf("%02d", $month);  // Đảm bảo tháng là 2 chữ số
        }, range(1, 12));  // Mảng tháng từ 01 đến 12

        $months = [];
        $revenues = [];
        $orders = [];

        // Tạo mảng mặc định với giá trị là 0 cho mỗi tháng
        foreach ($allMonths as $month) {
            $months[] = $month;
            $revenues[] = 0;  // Giá trị mặc định là 0 cho doanh thu
            $orders[] = 0;    // Giá trị mặc định là 0 cho số lượng đơn hàng
        }

        // Cập nhật giá trị từ cơ sở dữ liệu vào mảng nếu có dữ liệu cho tháng đó
        foreach ($monthlyData as $data) {
            $monthIndex = array_search(str_pad($data->month, 2, '0', STR_PAD_LEFT), $months);
            if ($monthIndex !== false) {
                $revenues[$monthIndex] = $data->total_revenue;
                $orders[$monthIndex] = $data->total_orders;
            }
        }

        // Trả về các dữ liệu vào view
        return view('admin.index', [
            'months' => $months,
            'revenues' => $revenues,
            'orders' => $orders,
            'today_revenue' => $todayData->today_revenue ?? 0,  // Doanh thu hôm nay
            'today_orders' => $todayData->today_orders ?? 0,    // Số lượng sản phẩm bán hôm nay
            'total_revenue' => $totalData->total_revenue ?? 0,    // Tổng doanh thu
            'total_orders' => $totalData->total_orders ?? 0,      // Tổng số sản phẩm bán
        ]);
    }






    function sub_category_edit($data){
        $decodedData = json_decode($data, true);
        $id=$decodedData[0];
        $name = $decodedData[1] ?? null; // Gán phần tử đầu tiên
        $description = $decodedData[2] ?? null; // Gán phần tử thứ hai
        $parent_id = $decodedData[3] ?? null;
        $subCategory = SubCategory::find($id);

        $subCategory->category_id = $parent_id;
        $subCategory->name = $name;
        $subCategory->description = $description;
        $subCategory->save();
        toastr()->addSuccess('Your work has been save!!');
        return redirect()->back();
    }
    function sub_category_delete($id){
        $data = SubCategory::find($id);
        toastr()->addSuccess('Deleted: ' . $data->name . ' Successful!!');
        $data->delete();
        return redirect()->back();
    }
    function sub_category_view(){
        $data = SubCategory::all();
        $categories = Category::all()->pluck('name', 'id'); // Lấy danh sách các category theo id
        $category = Category::all();
        return view('admin.category.sub_category', compact('data', 'categories','category'));
    }
    function add_sub_category($data){
        $decodedData = json_decode($data, true);
        $name = $decodedData[0] ?? null; // Gán phần tử đầu tiên
        $description = $decodedData[1] ?? null; // Gán phần tử thứ hai
        $parent_id = $decodedData[2] ?? null;
        $subCategory = new SubCategory();
        $subCategory->category_id = $parent_id;
        $subCategory->name = $name;
        $subCategory->description = $description;
        $subCategory->save();
        return redirect()->back();
    }
    function view_product(){
        $sellerId = Seller::where('user_id',Auth::user()->id)->first(); // Thay thế bằng ID người bán mà bạn muốn lọc
        $sellerId = $sellerId->id;
        $products = Product::where('seller_id', $sellerId)->paginate(6);
        foreach ($products as $item) {
            $item->discounted_price = $item->price * 0.95;
        }
        $category = SubCategory::all();
        return view('admin.product.view_product',compact('products','category'));
    }
    function add_product(Request $request){
        $seller = Seller::where('user_id', Auth::user()->id)->first();
        $image = $request->image;
        if($image){
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('products',$image_name);
        }
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' =>$request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category,
            'image' => $image_name,
            'seller_id' =>$seller->id ,
        ];

        // Tạo sản phẩm mới
        $product = Product::create($data);
        toastr()->addSuccess('Successful!!!');
        return redirect()->back();
    }

    function add_product_view(){
        $SubCategory = SubCategory::all();
        return view('admin.product.product',compact('SubCategory'));
    }

    function edit_category($data){
        $decodedData = json_decode(urldecode($data), true);
        $id = $decodedData[0];
        $name = $decodedData[1];
        $description = $decodedData[2];
        $category = Category::find($id);
        $category->name = $name;
        $category->description = $description;
        $category->save();
        toastr()->addSuccess('Successful!!!');
        return redirect()->back();
    }
    function add_category_view(){
        $data = Category::all();
        return view('admin.category.category',compact('data'));
    }
    function selected_category(Request $request) {
        $search = $request->search;
        // Sử dụng get() thay vì all() để lấy kết quả từ truy vấn
        $data = Category::where('name', 'LIKE', '%' . $search . '%')->get();
        return view('admin.category.category', compact('data'));
    }

    function delete_category($id){
        $data = Category::find($id);
        toastr()->addSuccess('Xóa danh mục: ' . $data->name . ' thành công!!');

        $data->delete();

        return redirect()->back();
    }
    function add_category(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255', // Tên sản phẩm là bắt buộc
            'description' => 'nullable|string', // Mô tả có thể null
        ]);
        // Lưu dữ liệu vào mảng để tạo sản phẩm
        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        // Tạo sản phẩm mới
        $category = Category::create($data);

        if (!$category) {
            return redirect()->route('product.create')->with('error', 'Product creation not successful');
        }
        toastr()->addSuccess('Thêm danh mục thành công');
        return redirect()->back();
    }

    function delete_product($id){
        $data = Product::find($id);
        toastr()->addSuccess('Xóa danh mục: ' . $data->name . ' thành công!!');

        $data->delete();

        return redirect()->back();
    }

    public function editProduct(Request $request)
    {
        $productId = $request->input('productId');
        $name = $request->input('name');
        $description = $request->input('description');
        $price = $request->input('price');
        $category_id = $request->input('category_id');
        if (empty($name) || empty($price) || empty($category_id)) {
            return response()->json(['success' => false, 'message' => 'Missing required fields'], 400);
        }
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if($image){
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move('products',$image_name);
                $product->image = $image_name;
            }
        }
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->category_id = $category_id;
        $product->save();
        toastr()->addSuccess('Successful!!!');
    }

}
