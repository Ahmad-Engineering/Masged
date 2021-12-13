<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id();

            $table->string  ('course_name');
            $table->foreign('course_name')->on('courses')->references('name');

            $table->foreignId('course_id');
            $table->foreign('course_id')->on('courses')->references('id');

            $table->foreignId('student_id');
            $table->foreign('student_id')->on('students')->references('id');

            $table->float('marks');

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
        Schema::dropIfExists('marks');
    }
}
