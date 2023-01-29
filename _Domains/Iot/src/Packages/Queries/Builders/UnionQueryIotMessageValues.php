<?php

namespace Safitech\Iot\Packages\Queries\Builders;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Safitech\Iot\Support\Facades\IotMessageValueDbMapper;

class UnionQueryIotMessageValues
{
    public function getUnifiedQuery(array $values): Builder
    {
        // TODO: empty values -> all

        return Db::query()->from(
            $this->unifyQueries($values)
        );
    }

    protected function unifyQueries(array $values, Builder $parent_query = null): Builder
    {
        $value_type = array_pop($values);

        $table_name = IotMessageValueDbMapper::getTableName($value_type);

        $query = DB::table($table_name)
            ->select(["$table_name.*"])
            ->addSelect(DB::raw("'$value_type' as type"));

        if (! is_null($parent_query)) {
            $query = $parent_query->union($query);
        }

        if (! empty($values)) {
            return $this->unifyQueries($values, $query);
        }

        return $query;
    }
}
