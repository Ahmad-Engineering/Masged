<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasgedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masgeds', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->string('info', 100)->nullable();
            $table->string('location', 50);
            
            $table->foreignId('manager_id');

            $table->foreign('manager_id')->on('managers')->references('id');
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
        Schema::dropIfExists('masgeds');
    }
}
