<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('circulation');
            $table->string('authenticatedCirculation');
            $table->integer('level');
            $table->string('owner');
            $table->string('color');
            $table->decimal('mileage', 8, 2);
            $table->string('licensePlate');
            $table->string('chassis');
            $table->string('person');
            $table->integer('phone');
            $table->integer('userId');

            $table->biginteger('idReception')->unsigned();
            $table->foreign('idReception')->references('id')->on('receptions');
            $table->biginteger('idBrand')->unsigned();
            $table->foreign('idBrand')->references('id')->on('brands');
            $table->biginteger('idType')->unsigned();
            $table->foreign('idType')->references('id')->on('types');



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
        Schema::dropIfExists('generals');
    }
}
