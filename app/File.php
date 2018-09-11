<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'user_id','file_category_id','file_path','type','file_metadata','created_by','updated_by'
        ];
}
