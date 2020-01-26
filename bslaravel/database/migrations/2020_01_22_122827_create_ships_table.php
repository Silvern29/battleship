<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('size');
            $table->integer('direction');
            $table->string('coo')->nullable();
            $table->integer('hits');
            $table->boolean('sunk');
            $table->timestamps();
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->integer('game_id')->unsigned()->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('ships');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
