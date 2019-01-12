<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description',
        ];

      /*  public function file_category_type(){
            return $this->hasOne('App\FileCategory','id','file_category_id');
        }
        public function get_category_id($id)
        {
            return \App\FileCategory::where('id',$id)->first();
        }*/


}
