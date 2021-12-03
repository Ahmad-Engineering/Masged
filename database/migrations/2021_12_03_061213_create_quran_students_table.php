<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuranStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quran_students', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id');
            $table->foreign('student_id')->on('students')->references('id');

            $table->foreignId('quran_id');
            $table->foreign('quran_id')->on('qurans')->references('id');
            
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
        Schema::dropIfExists('quran_students');
    }
}
