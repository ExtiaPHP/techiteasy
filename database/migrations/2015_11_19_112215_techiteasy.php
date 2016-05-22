<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Techiteasy extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login', '255');
            $table->string('password', '255');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('level', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->integer('point');
        });

        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });


        Schema::create('answer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->boolean('verify');
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('question')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('answer');
        Schema::dropIfExists('question');
        Schema::dropIfExists('category');
        Schema::dropIfExists('user');
    }

}
