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


}
