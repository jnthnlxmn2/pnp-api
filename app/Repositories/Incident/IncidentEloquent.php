<?php

namespace App\Repositories\Incident;

use App\Incident;
use App\Repositories\Common\Eloquent\EloquentRepository;
use Auth;
class IncidentEloquent extends EloquentRepository implements IncidentRepository{
    protected $model;

    public function __construct(Incident $Incident){
        $this->model = $Incident;
        $this->options = ['paginate' => 15,'limit' => 0,'order' => 'desc'];
    }


    public function getAll($options = []){
        $options = $this->getOptions($options);
        return $this->model->orderBy('created_at','DESC')
                    ->orderBy('created_at','desc')
                    ->limit($options['limit'])
                    ->paginate($options['paginate']);
        }

    
    
}
?>