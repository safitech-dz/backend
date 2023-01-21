<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('topic')->unique();

            $table->tinyInteger('qos');

            $table->boolean('retain');

            $table->string('frequency_event')->nullable();

            $table->text('description')->nullable();

            // TODO: refactor enum value
            $table->enum('type', [
                'boolean', 'date', 'float', 'integer', 'string', 'text', 'time', 'json',
            ]);

            // ? use JSON column
            $table->text('rules');
        });
    }

    public function down()
    {
        throw new Exception('No rolling back');
    }
};
