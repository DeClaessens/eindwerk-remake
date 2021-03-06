<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('voornaam');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('imageUrl')->default('/img/default-profile-image.png');
            $table->string('bio');
            $table->string('favoriteArtists');
            $table->integer('birthday');
            $table->string('provider_user_id');
            $table->string('provider');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
