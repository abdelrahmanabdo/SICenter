<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
class AttendanceController extends Controller
{
    public function get_my_attendance () {
        if( \Auth::user()->role == 'Admin' || \Auth::user()->role == 'Admin' ){
        $attendances = Attendance::with(['lesson' , 'user' , 'user.student' , 'user.student.details'])
                                 ->orderBy('lesson_id','desc')
                                 ->get();
        }else{
            $attendances = Attendance::where('user_id',\Auth::id())
                                 ->with(['lesson'])
                                 ->orderBy('id','desc')
                                 ->get();
        }

        return view('pages.attendance',['data' => $attendances]);
    }
}