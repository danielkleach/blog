<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /***************************************/
    /************ Relationships ************/
    /***************************************/

    public function post()
    {
        return $this->hasMany('App\Post');
    }
}
