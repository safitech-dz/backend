<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Safitech\Iot\Packages\IotMessages\IotMessageValueDbMapper;

return new class extends Migration
{
    protected IotMessageValueDbMapper $data_entity_mapper;

    public function __construct()
    {
        $this->data_entity_mapper = app()->make(IotMessageValueDbMapper::class);
    }

    protected function create(string $table_name, callable $value_column_callback)
    {
        Schema::create($table_name, function (Blueprint $table) use ($value_column_callback) {
            // TODO: primary ?
            $table->foreignId('iot_message_id')->constrained()->cascadeOnDelete();

            call_user_func_array($value_column_callback, [$table]);
        });
    }

    public function up()
    {
        // ! NOT DELETABLE & NOT DELETABLE
        Schema::create('iot_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at');

            $table->string('canonical_topic');
            $table->string('topic_user_id');
            $table->string('topic_client_id');

            // Refernces canonical_topic because it is simpler for querying
            $table->foreign('canonical_topic')->references('canonical_topic')->on('topics')
                ->cascadeOnUpdate();
        });

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
