<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
class AdminController extends Controller
{
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
        $products = Product::paginate(6);
        $category = SubCategory::all();
        return view('admin.product.view_product',compact('products','category'));
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
