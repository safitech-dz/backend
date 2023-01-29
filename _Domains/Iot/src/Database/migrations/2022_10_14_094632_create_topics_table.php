<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Safitech\Iot\Packages\IotData\Values\IotValueTypesFacade;

return new class extends Migration
{
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('canonical_topic')->unique();

            $table->tinyInteger('qos');

            $table->boolean('retain');

            $table->string('frequency_event')->nullable();

            $table->text('description')->nullable();

            $table->enum('type', IotValueTypesFacade::all());

            // ? use JSON column
            $table->text('rules');
        });
    }

    public function down()
    {
        throw new Exception('No rolling back');
    }
};
