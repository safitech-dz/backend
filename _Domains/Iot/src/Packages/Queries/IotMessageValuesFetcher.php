<?php

namespace Safitech\Iot\Packages\Queries;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Safitech\Iot\Models\IotMessage;
use Safitech\Iot\Packages\IotData\Values\IotMessageValueCaster;
use Safitech\Iot\Packages\Queries\Builders\UnionQueryIotMessageValues;
use Safitech\Iot\Support\Facades\IotValueTypes;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder as SpatieQueryBuilder;

class IotMessageValuesFetcher
{
    public function __construct(
        protected IotMessageValueCaster $caster,
        protected UnionQueryIotMessageValues $union_query_iot_message_values
    ) {
    }

    public function get()
    {
        $query = $this->spatieQueryBuilder()
            ->allowedFilters([
                AllowedFilter::beginsWithStrict('canonical_topic'), // ! % in [%u,%d] isn't escaped
                'topic_client_id',
                'topic_user_id',
                AllowedFilter::exact('value', 'iot_message_values.value', false),
                'created_at',
                // TODO: add scopes
            ])
            ->defaultSort('id')
            ->allowedSorts('id');
        // TODO: handle InvalidFilterQuery+InvalidSortQuery exception

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
            ->fromSub($this->union_query_iot_message_values->getUnifiedQuery(IotValueTypes::all()), 'iot_message_values')
            ->join('iot_messages', 'iot_messages.id', '=', 'iot_message_values.iot_message_id');
    }

    protected function spatieQueryBuilder(): SpatieQueryBuilder
    {
        return app()->make(
            SpatieQueryBuilder::class,
            ['subject' => $this->baseQuery()]
        );
    }
}
