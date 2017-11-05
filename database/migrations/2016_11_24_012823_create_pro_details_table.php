<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpu');
            $table->string('ram');
            $table->string('screen');
            $table->string('vga');
            $table->string('storage');
            $table->string('exten_memmory');
            $table->string('cam1');
            $table->string('cam2');
            $table->string('sim');
            $table->string('connect');
            $table->string('pin');            
            $table->string('os');            
            $table->text('note');            
            $table->integer('pro_id')->unsigned();
            $table->foreign('pro_id')->references('id')->on('products')->onDelete('cascade');;     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pro_details');
    }
}
