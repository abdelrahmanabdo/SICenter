<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id' , 'name' , 'mobile' , 'guardianـmobile' ,'guardianـjob' , 'address', 'class_year'  , 'appointment','is_new'
    ];

    // User
    public function user ( ) {
        return $this->belongsTo('App\User' , 'user_id');
    }
}
