<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 100)->nullable(false);
            $table->integer('total_pages')->nullable(false)->unsigned();
            $table->decimal('price', 6, 2)->nullable(false);
            $table->string('cover_img_url', 255);
            $table->integer('year_published')->nullable(false)->unsigned();
            $table->bigInteger('genre_id')->nullable(false)->unsigned();
            $table->bigInteger('author_id')->nullable(false)->unsigned();
            $table->bigInteger('publisher_id')->nullable(false)->unsigned();
            $table->bigInteger('language_id')->nullable(false)->unsigned();
            $table->integer('ranking')->nullable(false)->unsigned();
            $table->string('resena', 255)->nullable(false);
            $table->bigInteger('isbn')->nullable(false)->unsigned();
            $table->timestamps();
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('publisher_id')->references('id')->on('publishers');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
