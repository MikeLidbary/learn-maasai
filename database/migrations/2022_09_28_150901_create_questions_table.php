<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('english_word');
            $table->string('maasai_word');
            $table->string('question_image')->nullable()->comment("The question image path");
            $table->string('answer_image')->nullable()->comment("The answer image path");
            $table->string('choice_pull')->nullable()->comment("The pull of choices for this number. To help differentiate which question the learner is answering.");
            $table->string('right_choice')->nullable()->comment("The correct choice");
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
        Schema::dropIfExists('questions');
    }
}
