<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id');
            $table->integer('pro_id');
            $table->foreign('admin_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->foreign('pro_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();

            //
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
