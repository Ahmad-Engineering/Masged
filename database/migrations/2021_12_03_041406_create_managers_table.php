<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Routing\Generator\Dumper\GeneratorDumper;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 45);
            $table->string('last_name', 45);
            $table->string('email', 45)->unique()->nullable();
            $table->string('password');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('phone', 20);
            $table->integer('age');
            $table->enum('status', ['Active', 'Disabled'])->default('Active');

            $table->foreignId('masged_id');

            $table->foreign('masged_id')->on('masgeds')->references('id');
            
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
        Schema::dropIfExists('managers');
    }
}
