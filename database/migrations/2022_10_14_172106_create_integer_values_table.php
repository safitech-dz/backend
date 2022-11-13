<?php

use Database\Concerns\IotDataValue;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use IotDataValue;

    public function up()
    {
        $this->create(config('iot-data.tables-map.integer'));

        Schema::table(config('iot-data.tables-map.integer'), function (Blueprint $table) {
            $table->bigInteger('value');
        });
    }

    public function down()
    {
        Schema::dropIfExists(config('iot-data.tables-map.integer'));
    }
};
