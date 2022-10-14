<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iot_data_id');
            $table->foreign('iot_data_id')->references('id')->on('iot_data');
            $table->timestamps();

            $table->time('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_values');
    }
};
