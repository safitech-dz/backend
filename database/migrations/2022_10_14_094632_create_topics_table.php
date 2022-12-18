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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('topic')->unique();

            $table->tinyInteger('qos');

            $table->boolean('retain');

            $table->string('frequency_event')->nullable();

            $table->text('description')->nullable();

            $table->enum('type', [
                'boolean', 'date', 'float', 'integer', 'string', 'text', 'time', 'json',
            ]);

            // TODO: name it validation
            // ? use JSON column
            $table->text('format');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
};
