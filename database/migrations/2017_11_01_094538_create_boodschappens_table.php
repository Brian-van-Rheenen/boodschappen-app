<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoodschappensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boodschappen', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('gebruikers_id');
            $table->string('type');
            $table->string('hoeveelheid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boodschappens');
    }
}
