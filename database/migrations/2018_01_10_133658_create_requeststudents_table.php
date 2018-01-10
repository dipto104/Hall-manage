<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequeststudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requeststudents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('studentid')->unique();
            $table->string('name');
            $table->string('department');
            $table->integer('roomno')->nullable();
            $table->string('studenttype');
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
        Schema::dropIfExists('requeststudents');
    }
}
