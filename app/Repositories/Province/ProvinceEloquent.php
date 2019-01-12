<?php

namespace App\Repositories\Province;

use App\Province;
use App\Repositories\Common\Eloquent\EloquentRepository;
use Auth;
class ProvinceEloquent extends EloquentRepository implements ProvinceRepository{
    protected $model;

    public function __construct(Province $Province){
        $this->model = $Province;
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