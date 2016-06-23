<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePotentialMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potentialmatches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user1')->unsigned();
            $table->foreign('user1')->references('id')->on('users')->onDelete('cascade');
            $table->integer('user2')->unsigned();
            $table->foreign('user2')->references('id')->on('users')->onDelete('cascade');
            $table->integer('concert_id');
            $table->foreign('concert_id')->references('id')->on('concerts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('potentialmatches');
    }
}
