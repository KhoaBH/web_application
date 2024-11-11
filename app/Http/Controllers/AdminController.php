<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    function add_category_view(){
        return view('admin.category');
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
        $product = Category::create($data);

        if (!$product) {
            return redirect()->route('product.create')->with('error', 'Product creation not successful');
        }
        toastr()->addSuccess('Thêm danh mục thành công');
        return redirect()->back();
    }
}