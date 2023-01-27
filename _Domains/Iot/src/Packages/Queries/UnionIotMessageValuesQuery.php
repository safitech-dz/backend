<?php

namespace Safitech\Iot\Packages\Queries;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Safitech\Iot\Models\IotMessage;
use Safitech\Iot\Packages\IotData\Values\DataEntityMapper;

class UnionIotMessageValuesQuery
{
    protected array $messages_ids;

    protected array $value_types;

    protected EloquentCollection $collection;

    public function __construct(
        protected DataEntityMapper $data_entity_mapper
    ) {
        $this->value_types = $data_entity_mapper->value_types;

        $this->collection = new EloquentCollection([]);
    }

    /**
     * 3 queries
     * - pluck messages IDs
     * - get unified values
     * - load messages for values
     */
    public function all()
    {
        $this->setMessagesIds();

        $results = $this->fetchIotMessageValues($this->value_types);

        foreach ($results as $result) {
            $model = $this->data_entity_mapper->getModelInstance($result->type)
                ->forceFill([
                    'id' => $result->id,
                    'iot_message_id' => $result->iot_message_id,
                    'value' => $this->castValue($result->value, $result->type),
                ]);

            $this->collection->push($model);
        }

        return $this->collection->load('iotMessage');
    }

    protected function setMessagesIds()
    {
        $this->messages_ids = $this->filterMessages(IotMessage::query())->pluck('id')->toArray();
    }

    protected function fetchIotMessageValues(array $values, Builder $parent_query = null)
    {
        $value_type = array_pop($values);

        $table_name = $this->data_entity_mapper->getTableName($value_type);

        $query = DB::table($table_name)
            ->select(["$table_name.*"])
            ->addSelect(DB::raw("'$value_type' as type"))
            ->whereIn('iot_message_id', $this->messages_ids);

        if (! is_null($parent_query)) {
            $query->union($parent_query);
        }

        if (! empty($values)) {
            return $this->fetchIotMessageValues($values, $query);
        }

        return $this->filterValues($query)->get();
    }

    protected function filterMessages(EloquentBuilder $query): EloquentBuilder
    {
        return $query;
    }

    protected function filterValues(Builder $query): Builder
    {
        return $query->orderBy('iot_message_id');
    }

    // TODO: extract
    protected function castValue(mixed $value, string $type): mixed
    {
        return match ($type) {
            'json' => json_decode($value),
            'integer' => (int) $value,
            'boolean' => (bool) $value,
            'float' => (float) $value,
            default => $value,
        };
    }
}
