<?php

namespace App\Repositories\Record;

use App\Record;
use App\User;
use App\Incident;       
use App\Province;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
use DB;


use App\Repositories\Common\Eloquent\EloquentRepository;
use Auth;
class RecordEloquent extends EloquentRepository implements RecordRepository{
    protected $model;

    public function __construct(Record $Record,Incident $Incident,Province $Province,User $user){
        $this->model = $Record;
        $this->user = $user;
        $this->province= $Province;
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

        for($y=0;$y<$count;$y++){
            $officer = $this->user->where('id',$records[$y]['aut_name_of_desk_officer'])
                                    ->first();
            $records[$y]['desk_officer'] = $officer;
        }

        return $records;
    }
    
    public function search($request = []){
        $records = $this->model
        ->when(isset($request), function($query) use ($request){
            if(isset($request['gender'])){
                 $query->where('itm_a_gender',$request['gender']);
            }
            if(isset($request['place_of_incident'])){
                $query->where('place_of_incident',$request['place_of_incident']);
            }
           if(isset($request['18below_report'])){
               if($request['18below_report']==='true'){
                  $query->where('itm_b_age', '<', 18);
               }
           }
           if(isset($request['18above_report'])){
               if($request['18above_report']==='true'){
                 $query->where('itm_b_age', '>=', 18);
                }
           }
           if(isset($request['18below_victim'])){
                if($request['18below_victim']==='true'){
                $query->where('itm_c_age', '<', 18);
                }
           }
           if(isset($request['18above_victim'])){
            if($request['18above_victim']==='true'){
            $query->where('itm_c_age', '>=', 18);
            }
          }
          if(isset($request['from']) && isset($request['to'])){
            $query->whereBetween('date_reported',[$request['from'],$request['to']]);
          }
        }) 
        ->get();



        $count = count($records);

        for($x=0;$x<$count;$x++){
            $incident = $this->incident->where('id',$records[$x]['incdnt_type_id'])
                                    ->first();
            $records[$x]['incident_type'] = $incident;
        }

        for($x=0;$x<$count;$x++){
            $incident = $this->province->where('id',$records[$x]['place_of_incident'])
                                    ->first();
            $records[$x]['incident_place'] = $incident;
        }

        for($y=0;$y<$count;$y++){
            $officer = $this->user->where('id',$records[$y]['aut_name_of_desk_officer'])
                                    ->first();
            $records[$y]['desk_officer'] = $officer;
        }


        return $records;

    }
    
    
}
?>                 