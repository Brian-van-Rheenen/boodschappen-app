<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroceriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groceries', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('user');
            $table->string('productID')->nullable();
            $table->string('description');
            $table->integer('quantity');
            $table->double('priceWas')->nullable();
            $table->double('priceNow')->nullable();
            $table->string('discount')->nullable();
            $table->tinyInteger('completed')->default(0);
            $table->string('image')->nullable();
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
        Schema::dropIfExists('groceries');
    }
}
