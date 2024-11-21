<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id(); // Khóa chính tự tăng
            $table->string('name'); // Tên subcategory
            $table->unsignedBigInteger('category_id'); // Liên kết với bảng categories
            $table->text('description')->nullable(); // Mô tả ngắn (có thể để trống)
            $table->boolean('status')->default(1); // Trạng thái hoạt động (1: hoạt động, 0: ẩn)
            $table->timestamps(); // Tự động thêm created_at và updated_at
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}
