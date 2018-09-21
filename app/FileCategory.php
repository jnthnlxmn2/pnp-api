<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    protected $hidden = ['deleted'];

    public function category(){
        $this->belongsTo('App\File','file_category_id');
    }
}
