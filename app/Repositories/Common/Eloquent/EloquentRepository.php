<?php

namespace App\Repositories\Common\Eloquent;

// use App\One\Common\Parameters\FilterParameters;
// use App\One\Common\Parameters\PaginationParameters;
// use App\One\Common\Parameters\SortParameters;
use Auth;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository
{
    // use EloquentFilterable, EloquentPaginatable, EloquentSortable;

    /**
     * @var Model
     */
    protected $model;
    protected $options;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->options = [
            'paginate' => 15,
            'limit' => 0,
            'order' => 'DESC',
            'order_by' => 'created_at',
        ];
    }

    /**
     * @param PaginationParameters $paginationParameters
     * @param FilterParameters $filterParameters
     * @param SortParameters $sortParameters
     * @return array
     */
    public function paginated(PaginationParameters $paginationParameters, FilterParameters $filterParameters = null, SortParameters $sortParameters = null)
    {
        $query = $this->model->query();

        if ($filterParameters) {
            $this->buildFilters($filterParameters, $query);
        }

        if ($sortParameters) {
            $this->buildSorting($sortParameters, $query);
        }

        $total = $query->count();

        $this->buildPagination($paginationParameters, $query);

        return $this->paginate($paginationParameters, $query->get(), $total);
    }

    /**
     * @param $id
     * @param array|null $with
     * @return mixed
     */
    public function find($id, $with = [])
    {
        return $this->model->with($with)->findOrFail($id);
    }

    /**
     * @param array $attr
     * @return mixed
     */
    public function save($attr = [])
    {
        $model = new $this->model;
        $model->fill($attr);
        $model->save();

        return $model;
    }

    /**
     * @param $id
     * @param array $attr
     */
    public function update($id, $attr = [])
    {
        $model = new $this->model;
        $update = $model->find($id);
        $update->fill($attr);
        $update->save();
        return $update;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $this->model->destroy($id);
    }

    /**
     * @param $date
     * @return bool|string
     */
    public function parseDate($date)
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }

    public function getOptions($options = [])
    {
        if (!isset($options['paginate']) || (!$options['paginate'] && $options['paginate'] < 1)) {
            $options['paginate'] = $this->options['paginate'];
        }
        if (!isset($options['limit']) || (!$options['limit'] && $options['limit'] < 1)) {
            $options['limit'] = $this->options['limit'];
        }
        if (!isset($options['order']) || (!$options['order'])) {
            $options['order'] = $this->options['order'];
        }
        return $options;
    }

    /**
     * @param array $attr
     * @return mixed
     */
    public function saveByUser($attr = [], $field = 'user_id')
    {
        $attr[$field] = Auth::user()->id;
        $model = new $this->model;
        $model->fill($attr);
        $model->save();
        return $model;
    }
}
