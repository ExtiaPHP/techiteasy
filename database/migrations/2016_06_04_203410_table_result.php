<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_survey', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lastname', '255');
            $table->string('firstname', '255');
            $table->string('email', '255');
            $table->integer('questionnaire_id')->unsigned();
            $table->integer('rh_id')->unsigned();
            $table->foreign('questionnaire_id')->references('id')->on('questionnaire');
            $table->foreign('rh_id')->references('id')->on('rh');
            $table->timestamps();
        });

        Schema::create('result', function (Blueprint $table) {
            $table->integer('result_survey_id')->unsigned();
            $table->foreign('result_survey_id')->references('id')->on('result_survey');
            $table->string('question', '255');
            $table->string('answer', '255');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_survey');
        Schema::dropIfExists('result');
    }
}
