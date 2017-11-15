<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('termno');
            $table->integer('messno');
            $table->integer('studentid');
            $table->string('name');
            $table->integer('roomno');
            $table->string('department');
            $table->integer('hallscroll')->nullable();
            $table->integer('bankscroll')->nullable();
            $table->date('receivedate')->nullable();
            $table->integer('fee')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('due')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
