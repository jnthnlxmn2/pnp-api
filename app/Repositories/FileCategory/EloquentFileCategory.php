<?php

namespace App\Repositories\FileCategory;

use App\FileCategory;
use App\Repositories\Common\Eloquent\EloquentRepository;
use Auth;
class FileCategoryEloquent extends EloquentRepository implements FileCategoryRepository{
    protected $model;

    public function __construct(FileCategory $FileCategory){
        $this->model = $FileCategory;
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