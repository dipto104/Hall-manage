<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('termno');
            $table->integer('messno');
            $table->date('startat');
            $table->date('finishat');
            $table->integer('vacnumber')->nullable();
            $table->integer('messfee');
            $table->integer('extrafee')->nullable();
            $table->integer('fine');
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
        Schema::dropIfExists('messes');
    }
}
