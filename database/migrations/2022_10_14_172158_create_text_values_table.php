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
        $this->create(config('iot-data.tables-map.text'));

        Schema::table(config('iot-data.tables-map.text'), function (Blueprint $table) {
            $table->text('value');
        });
    }

    public function down()
    {
        Schema::dropIfExists(config('iot-data.tables-map.text'));
    }
};
