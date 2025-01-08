<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->string('status')->default('pending'); // Thêm cột status với giá trị mặc định là 'pending'
        });
    }
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
