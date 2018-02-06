<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id')->unsigned();
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->string('name');
            $table->integer('price');
            $table->integer('featured')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addons');
    }
}
