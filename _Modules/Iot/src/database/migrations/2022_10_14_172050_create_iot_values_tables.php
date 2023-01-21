<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Safitech\Iot\Packages\IotData\Values\DataEntityMapper;

return new class extends Migration
{
    protected DataEntityMapper $data_entity_mapper;

    public function __construct()
    {
        $this->data_entity_mapper = app()->make(DataEntityMapper::class);
    }

    protected function create(string $table_name, callable $value_column_callback)
    {
        Schema::create($table_name, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('topic');
            $table->string('topic_user_id');
            $table->string('topic_client_id');

            $table->foreign('topic')->references('topic')->on('topics');
        });

        // TODO: move $value_column_callback to Schema::create
        Schema::table($table_name, $value_column_callback);
    }

    public function up()
    {
        $this->create($this->data_entity_mapper->getTableName('boolean'), function (Blueprint $table) {
            $table->boolean('value');
        });

        $this->create($this->data_entity_mapper->getTableName('integer'), function (Blueprint $table) {
            $table->bigInteger('value');
        });

        $this->create($this->data_entity_mapper->getTableName('float'), function (Blueprint $table) {
            $table->float('value');
        });

        $this->create($this->data_entity_mapper->getTableName('time'), function (Blueprint $table) {
            $table->time('value');
        });

        $this->create($this->data_entity_mapper->getTableName('date'), function (Blueprint $table) {
            $table->date('value');
        });

        $this->create($this->data_entity_mapper->getTableName('text'), function (Blueprint $table) {
            $table->text('value');
        });

        $this->create($this->data_entity_mapper->getTableName('string'), function (Blueprint $table) {
            $table->string('value');
        });

        $this->create($this->data_entity_mapper->getTableName('json'), function (Blueprint $table) {
            $table->longText('value');
        });
    }

    public function down()
    {
        throw new Exception('No rolling back');
    }
};
