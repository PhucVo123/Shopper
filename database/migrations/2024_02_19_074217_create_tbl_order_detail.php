<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order_detail', function (Blueprint $table) {
            $table->Increments('orderdetail_id');
            $table->string('orderdetail_id_product');
            $table->string('orderdetail_id_order');
            $table->integer('orderdetail_quantity');
            $table->integer('orderdetail_price');
            $table->integer('orderdetail_status');
            $table->integer('orderdetail_status_rating');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_order_detail');
    }
};
