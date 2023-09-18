<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** 'assessment_id', 'section', 'category', 'content', 'type', 'answeroptions', 'answer'
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assessment_id')->null;
            $table->string('section'); //A-D, a question can fall under any session but can only appear once on the db
            $table->string('category'); // the question categorization: math, science, english, current affairs, technology, politics, engineering, geography, (as the case may be)
            $table->string('content'); // the question
            $table->enum('type', ['multiple_choice', 'true_false']); //the question type
            $table->string('answeroptions'); // contains the options from which the correct answer(s) is/are found, the options can be separated with a comma (,)
            $table->string('answer'); // the correct answer(s)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
