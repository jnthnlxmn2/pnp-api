<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'user_id','name','file_category_id','file_path','type','file_metadata','created_by','updated_by'
        ];

        public function file_category_type(){
            return $this->hasOne('App\FileCategory','id','file_category_id');
        }
        public function get_category_id($id)
        {
            return \App\FileCategory::where('id',$id)->first();
        }
}
