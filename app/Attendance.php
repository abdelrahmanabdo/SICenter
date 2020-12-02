<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
                /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','lesson_id' ,'date' 
    ];

    // User
    public function user () {
        return $this->belongsTo('App\User' , 'user_id');
    }

    // Lesson
    public function lesson () {
        return $this->belongsTo('App\Lesson' , 'lesson_id');
    }
}