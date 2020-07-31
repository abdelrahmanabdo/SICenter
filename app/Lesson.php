<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_year','title' ,'description' , 'start_url' , 'join_url', 'start_time' , 'duration'
    ];
}
