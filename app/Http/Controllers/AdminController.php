<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    function view_product(){
        $products = Product::paginate(3);
        return view('admin.view_product',compact('products'));
    }
    function add_product(Request $request){
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
        ];

        // Tạo sản phẩm mới
        $product = Product::create($data);
        toastr()->addSuccess('Successful!!!');
        return redirect()->back();
    }

    function add_product_view(){
        $category = Category::all();
        return view('admin.product',compact('category'));
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
        return view('admin.category',compact('data'));
    }
    function selected_category(Request $request) {
        $search = $request->search;

        // Sử dụng get() thay vì all() để lấy kết quả từ truy vấn
        $data = Category::where('name', 'LIKE', '%' . $search . '%')->get();

        return view('admin.category', compact('data'));
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
        $quantity = $request->input('quantity');
        if (empty($name) || empty($price) || empty($quantity)) {
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
        $product->quantity = $quantity;
        $product->save();

    }

}
