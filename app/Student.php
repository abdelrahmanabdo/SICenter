<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','reservation_id' 
    ];

    // User
    public function user () {
        return $this->belongsTo('App\User' , 'user_id');
    }

    // details
    public function details () {
        return $this->belongsTo('App\Reservation' , 'reservation_id');
    }
}