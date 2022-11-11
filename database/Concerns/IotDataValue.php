<?php

namespace Database\Concerns;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

trait IotDataValue
{
    public function create(string $table_name)
    {
        Schema::create($table_name, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('topic');
            $table->string('topic_user_id');
            $table->string('topic_client_id');
        });
    }
}
