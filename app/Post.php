<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['date'];
    protected $casts = [
        'published' => 'boolean'
    ];

    /***************************************/
    /************ Relationships ************/
    /***************************************/

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    /***************************************/
    /*************** Methods ***************/
    /***************************************/

    public function getFormattedDateAttribute()
    {
        return $this->date->format('F j, Y');
    }

    /***************************************/
    /*************** Scopes ****************/
    /***************************************/

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }
}
