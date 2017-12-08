<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pro_id');
            $table->foreign('pro_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('customer_email');
            $table->string('customer_name');
            $table->integer('customer_rating');
            $table->string('review');
            $table->string('token')->nullable();
            $table->integer('status')->default('0');
            $table->integer('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->timestamps();
        });
        //
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
