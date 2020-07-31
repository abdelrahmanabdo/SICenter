<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function get_my_attendance () {
        return view('pages.attendance');
    }
}
