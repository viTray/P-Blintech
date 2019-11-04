<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('state');
            $table->string('extra');
            $table->string('description');
            $table->string('file');
            $table->biginteger('idReception')->unsigned();
            $table->foreign('idReception')->references('id')->on('receptions');

            $table->biginteger('idTitle')->unsigned();
            $table->foreign('idTitle')->references('id')->on('titles');
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
        Schema::dropIfExists('accesories');
    }
}
