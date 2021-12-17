<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('email', 45)->nullable();
            $table->string('first_name', 45);
            $table->string('last_name', 45);
            $table->string('phone', 45);
            $table->string('parent_phone', 45);
            $table->string('password');
            $table->integer('age');
            $table->boolean('status');
            $table->enum('gender', ['Male', 'Female']);

            // CREATE F.K COLUMN
            $table->string('masged_name');

            // SET PROPERTY
            $table->foreign('masged_name')->on('masgeds')->references('name');

            $table->foreignId('circle_id')->nullable();
            $table->foreign('circle_id')->on('circles')->references('id');

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
        Schema::dropIfExists('students');
    }
}
