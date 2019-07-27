<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_cart', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('book_id')->nullable(false)->unsigned();
            $table->bigInteger('cart_id')->nullable(false)->unsigned();
            $table->integer('quantity')->nullable(false)->unsigned();
            $table->decimal('price', 6, 2)->nullable(false);
            $table->decimal('subtotal', 10, 2)->nullable(false);
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('cart_id')->references('id')->on('carts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_cart');
    }
}
