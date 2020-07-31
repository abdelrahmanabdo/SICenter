<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\User;
use App\Reservation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{

       /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile' => ['required', 'string' , 'max:12', 'unique:users'],
            'password' => ['required', 'string', 'min:8' ],
            'name' => ['required', 'string' ],
            'mobile_number' => ['required', 'string'],
            'class_year' => ['required'],
        ]);
    }

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

    /**
     * Add New Student
     */
    public function add_student (Request $request) {

      $user = User::create([
         'mobile' => $request->mobile,
         'password' => Hash::make($request['password']),
         'is_active' => 1 ,
         'is_subscribed' => 1 ,
      ]);

      if($user) {
         $details = Reservation::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'guardianـmobile' => $request->guardianـmobile,
            'guardianـjob' => $request->guardianـjob,
            'address' => $request->address,
            'class_year' => $request->class_year,
         ]);

         if($details){
            
            $student = Student::create([
               'user_id' => $user->id,
               'reservation_id' => $details->id
            ]);

            $notification = array(
               'message' =>  'تم انشاء حساب الطالب بنجاح ', 
               'alert-type' => 'success'
           );
         }
      }else{
         $notification = array(
            'message' =>  'حدث خطأ اثناء تسجيل الحساب برجاء مراجعة البيانات جيدا' , 
            'alert-type' => 'error'
        );
      }

      return back()->with($notification);


    }
}
