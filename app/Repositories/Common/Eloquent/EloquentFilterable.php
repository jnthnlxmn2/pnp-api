<?php

namespace App\Repositories\Common\Eloquent;

use App\One\Common\Parameters\FilterParameters;
use Illuminate\Database\Eloquent\Builder;

trait EloquentFilterable
{
    /**
     * @param FilterParameters $filterParameters
     * @param Builder $query
     * @return Builder
     */
    public function buildFilters(FilterParameters $filterParameters, Builder $query)
    {
        foreach($filterParameters->getFilters() as $column => $value)
        {
            if(strpos($column, '.')) {
                $this->queryRelations($query, $column, $value);
            } else {
                $this->query($query, $column, $value);
            }
        }
        return $query;
    }

    /**
     * @param Builder $query
     * @param $column
     * @param $value
     */
    private function queryRelations(Builder $query, $column, $value)
    {
        list($relation_name, $column) = explode('.', $column, 2);

        if(!is_array($value)) {
            $query->whereHas($relation_name, function($subQuery) use ($column, $value) {
                $value = str_replace("ñ", "%C3%B1", $value);
                $subQuery->where($column, 'like', "%$value%");
            });
        } else {
            if(isset($value['equal'])) {
                $query->whereHas($relation_name, function($subQuery) use ($column, $value) {
                    $subQuery->where($column, $value);
                });
            }

            if(isset($value['not_equal'])) {
                $query->whereHas($relation_name, function($subQuery) use($column, $value) {
                    $subQuery->where($column, '!=', $value);
                });
            }
            //TODO: debatable
        }

    }

    /**
     * @param Builder $query
     * @param $column
     * @param $value
     */
    private function query(Builder $query, $column, $value)
    {
        if(is_array($value)) {
            if(isset($value['from'])) {
                $query->where($column, '>=', $value['from']);
            }

            if(isset($value['to'])) {
                $query->where($column, '<=', $value['to']);
            }

            if(isset($value['equal'])) {
                $query->where($column, '=', $value['equal']);
            }

            if(isset($value['not_equal'])) {
                $query->where($column, '!=', $value['not_equal']);
            }
        } else {
            $value = str_replace("ñ", "%C3%B1", $value);
            $query->where($column, 'like', "%$value%");
        }
    }
}
