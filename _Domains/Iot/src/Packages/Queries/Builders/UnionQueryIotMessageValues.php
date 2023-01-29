<?php

namespace Safitech\Iot\Packages\Queries\Builders;

use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Safitech\Iot\Support\Facades\IotMessageValueDbMapper;

class UnionQueryIotMessageValues
{
    public function getUnifiedQuery(array $values, ?callable $filter = null): Builder
    {
        // TODO: empty values -> all

        $query = Db::query()->from(
            $this->unifyQueries($values)
        );

        if ($filter) {
            call_user_func($filter, $query);

            if (! $query instanceof Builder) {
                throw new Exception('Filter callback should not stop the query building (Example: end query with get)');
            }
        }

        return $query;
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
