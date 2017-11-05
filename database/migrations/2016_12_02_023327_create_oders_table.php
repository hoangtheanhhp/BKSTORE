<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('c_id')->unsigned();
            $table->foreign('c_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('qty');
            $table->decimal('sub_total', 13, 2);
            $table->decimal('total', 13, 2);
            $table->integer('status');
            $table->string('type',50);
            $table->string('note');            
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
        Schema::drop('oders');
    }
}
