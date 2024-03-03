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
        Schema::create('tbl_rating', function (Blueprint $table) {
            $table->Increments('rating_id');
            $table->string('rating_user');
            $table->integer('rating_star');
            $table->string('rating_content');
            $table->integer('orderdetail_id');
            $table->integer('order');
            $table->string('datebegin');
            $table->integer('rating_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_rating');
    }
};
