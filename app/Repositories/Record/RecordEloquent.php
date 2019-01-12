<?php

namespace App\Repositories\Record;

use App\Record;
use App\Incident;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               

use App\Repositories\Common\Eloquent\EloquentRepository;
use Auth;
class RecordEloquent extends EloquentRepository implements RecordRepository{
    protected $model;

    public function __construct(Record $Record,Incident $Incident){
        $this->model = $Record;
        $this->incident = $Incident;
        $this->options = ['paginate' => 15,'limit' => 0,'order' => 'desc'];
    }


    public function getAll($options = []){
        $options = $this->getOptions($options);
        $records = $this->model->orderBy('created_at','DESC')
                    ->orderBy('created_at','desc')
                    ->limit($options['limit'])
                    ->paginate($options['paginate']);
        

        $count = count($records);

        for($x=0;$x<$count;$x++){
            $incident = $this->incident->where('id',$records[$x]['incdnt_type_id'])
                                    ->first();
            $records[$x]['incident_type'] = $incident;
        }

        return $records;
    }
    
    
}
?>                 