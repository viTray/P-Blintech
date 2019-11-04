<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivereds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date');
            $table->integer('qualification');
            $table->string('commentary');
            $table->string('firm');
            $table->string('photo');
            $table->string('personChecks');
            $table->string('firmPersonChecks');
            $table->integer('userId');

            $table->biginteger('idReception')->unsigned();
            $table->foreign('idReception')->references('id')->on('receptions');
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
        Schema::dropIfExists('delivereds');
    }
}
