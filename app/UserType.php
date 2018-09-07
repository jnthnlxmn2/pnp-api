<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $fillable = ['role','description'];

    public function user(){
        $this->belongsTo('App\User','user_id');
    }
}
