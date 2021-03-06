<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceptionImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reception_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->string('file');

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
        Schema::dropIfExists('reception_images');
    }
}
