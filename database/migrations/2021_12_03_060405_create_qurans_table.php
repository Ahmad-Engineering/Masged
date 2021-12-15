<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qurans', function (Blueprint $table) {
            $table->id();
            $table->integer('part_no');
            $table->integer('from_page');
            $table->integer('to_page');
            // $table->enum('status', ['Done', 'Waiting', 'Canceled'])->default('Waiting');

            $table->foreignId('circle_id');
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
        Schema::dropIfExists('qurans');
    }
}
