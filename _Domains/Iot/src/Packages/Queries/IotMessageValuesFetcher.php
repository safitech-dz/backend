<?php

namespace Safitech\Iot\Packages\Queries;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Safitech\Iot\Models\IotMessage;
use Safitech\Iot\Packages\IotData\Values\DataEntityMapper;
use Safitech\Iot\Packages\IotData\Values\IotMessageValueCaster;
use Safitech\Iot\Packages\Queries\Builders\UnionQueryIotMessageValues;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder as SpatieQueryBuilder;

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

    public function get()
    {
        /** @var SpatieQueryBuilder */
        $query = app()->make(
            SpatieQueryBuilder::class,
            ['subject' => $this->baseQuery()]
        );

        $query->allowedFilters([
            'canonical_topic',
            'topic_client_id',
            'topic_user_id',
            AllowedFilter::exact('iot_message_values.value'),
            'created_at',
        ]);
        // TODO: handle InvalidFilterQuery exception

        $messages = $query->get();

        foreach ($messages as $message) {
            unset($message->iot_message_id);

            $message->value = $this->caster->toType($message->value, $message->type);

            unset($message->type);
        }

        return $messages;
    }

    protected function baseQuery(): EloquentBuilder
    {
        return IotMessage::query()
            ->fromSub($this->union_query_iot_message_values->getUnifiedQuery($this->value_types), 'iot_message_values')
            ->join('iot_messages', 'iot_messages.id', '=', 'iot_message_values.iot_message_id');
    }
}
