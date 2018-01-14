<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermduesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termdues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('termno');
            $table->integer('studentid');
            $table->string('name');
            $table->string('roomno');
            $table->integer('totalmess');
            $table->integer('due');
            $table->string('remarks');
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
        Schema::dropIfExists('termdues');
    }
}