<?php

namespace App\One\Common\Repositories\Eloquent;

use App\One\Common\Parameters\PaginationParameters;
use Illuminate\Database\Eloquent\Builder;
use URL;
use Request;

trait EloquentPaginatable
{
    /**
     * @param  PaginationParameters $paginationParameters
     * @param  Builder              $query
     * @return Builder
     */
    public function buildPagination(PaginationParameters $paginationParameters, Builder $query)
    {
        $page = $paginationParameters->getPage();

        $limit = $paginationParameters->getLimit();

        return $query->skip($limit * ($page - 1))->take($limit);
    }

    /**
     * @param  PaginationParameters $paginationParameters
     * @param  array|collection $data
     * @param $total
     * @return array
     */
    public function paginate(PaginationParameters $paginationParameters, $data, $total)
    {
        $perPage = $paginationParameters->getLimit();
        $page = $paginationParameters->getPage();
        $from = $total ? ($page * $perPage) - $perPage + 1 : 0;

        $lastPage = ceil($total / $perPage);

        return [
            'total'         => $total,
            'per_page'      => $perPage,
            'current_page'  => $total == 0 ? 0 : $page,
            'last_page'     => $lastPage,
            'next_page_url' => ($page == $lastPage) ? null : URL::current() . "?page=" . ($page + 1) . "&" . http_build_query(Request::only(['search', 'limit', 'user_session'])),
            'prev_page_url' => ($page == 1) ? null : URL::current() . "?page=" . ($page - 1) . "&" . http_build_query(Request::only(['search', 'limit', 'user_session'])),
            'from'          => $from,
            'to'            => ($page == $lastPage) ? $total : $page * $perPage,
            'data'          => $data
        ];
    }
}
