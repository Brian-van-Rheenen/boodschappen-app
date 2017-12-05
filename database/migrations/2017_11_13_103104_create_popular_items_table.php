<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopularItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popular_items', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('productID')->nullable();
            $table->string('description');
            $table->double('priceWas')->nullable();
            $table->double('priceNow');
            $table->string('discount')->nullable();
            $table->string('image')->nullable();
            $table->integer('popularity');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('popular_items');
    }
}
