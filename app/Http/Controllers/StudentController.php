<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
   /**
    * Get All Studets
    */
    public function get_students () {
       $data =  Student::with(['user','details'])
                        ->whereHas('user',function($query){
                           $query->where('role','<>','Admin'); 
                        })->get();

      return view('pages.students',['data' => $data]);

    }
}
