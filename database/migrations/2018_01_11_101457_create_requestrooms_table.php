<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestrooms', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('roomno')->unique();
            $table->string('roomtype');
            $table->integer('capacity');
            $table->integer('occupy');
            $table->string('requesttype');
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
        Schema::dropIfExists('requestrooms');
    }
}
