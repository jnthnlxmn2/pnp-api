<?php

namespace App\One\Common\Repositories\Eloquent;

use App\One\Common\Parameters\SortParameters;
use Illuminate\Database\Eloquent\Builder;

trait EloquentSortable
{
    /**
     * @param SortParameters $sort
     * @param Builder $query
     * @return Builder
     */
    function buildSorting(SortParameters $sort, Builder $query)
    {
        $sort = $sort->getSort();
        foreach ($sort as $order) {
            $this->sortOrder($query, $order);
        }

        return $query;
    }

    /**
     * @param $query
     * @param $sort
     */
    private function sortOrder($query, $sort)
    {
        $column = explode('-', $sort);
        if (count($column) == 2) {
            $column = $column[1];
            $order = 'DESC';
        } else {
            $column = $column[0];
            $order = 'ASC';
        }
        $dotPost = strpos($column, '.');
        if ($dotPost !== false) {
            $relation = substr($column, 0, $dotPost);
            $relatedModel = $query->getModel()->{$relation}()->getRelated();
            $column = $relatedModel->getTable() .'.'. substr($column, $dotPost);
        }
        $query->orderBy($column, $order);
    }
}