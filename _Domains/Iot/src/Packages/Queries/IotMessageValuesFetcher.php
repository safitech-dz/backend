<?php

namespace Safitech\Iot\Packages\Queries;

use Illuminate\Database\Query\Builder;
use Safitech\Iot\Packages\IotData\Values\DataEntityMapper;
use Safitech\Iot\Packages\IotData\Values\IotMessageValueCaster;
use Safitech\Iot\Packages\Queries\Builders\UnionQueryIotMessageValues;

class IotMessageValuesFetcher
{
    protected array $value_types;

    public function __construct(
        protected DataEntityMapper $data_entity_mapper,
        protected IotMessageValueCaster $caster,
        protected UnionQueryIotMessageValues $union_query_iot_message_values
    ) {
        $this->value_types = $data_entity_mapper->value_types;
    }

    public function all()
    {
        $query = $this->baseQuery();

        $query = $this->filter($query);

        $query = $this->orderBy($query, 'iot_message_id');

        $messages = $query->get();

        foreach ($messages as $message) {
            unset($message->iot_message_id);

            $message->value = $this->caster->toType($message->value, $message->type);

            unset($message->type);
        }

        return $messages;
    }

    protected function baseQuery(): Builder
    {
        return $this->union_query_iot_message_values->getUnifiedQuery($this->value_types)
            ->join('iot_messages', 'id', '=', 'iot_message_id');
    }

    protected function filter(Builder $query, array $filters = []): Builder
    {
        if (empty($filters)) {
            return $query;
        }

        return $query
            // ->whereIn('iot_message_id', [1])
;
    }

    protected function orderBy(Builder $query, ?string $column = null): Builder
    {
        if (is_null($column)) {
            return $query;
        }

        return $query->orderBy($column);
    }
}
