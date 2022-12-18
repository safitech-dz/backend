<?php

use Database\Concerns\IotDataValueTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use IotDataValueTable;

    public function up()
    {
        $this->create(config('iot-data.tables-map.string'));

        Schema::table(config('iot-data.tables-map.string'), function (Blueprint $table) {
            $table->string('value');
        });
    }

    public function down()
    {
        Schema::dropIfExists(config('iot-data.tables-map.string'));
    }
};
