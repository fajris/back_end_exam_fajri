<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitRumahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_rumahs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('kavling');
            $table->string('blok');
            $table->string('no_rumah');
            $table->integer('harga_rumah');
            $table->integer('luas_tanah');
            $table->integer('luas_bangunan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_rumahs');
    }
}
