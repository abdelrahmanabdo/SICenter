<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson ;
use App\Reservation;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class LessonController extends Controller
{

    /**
     * Add new lesson
     */
    public function add_lesson (Request $request) {
        $validator = Validator::make($request->all(), [
                'class_year' => 'required|string',
                'topic' => 'required',
                'start_time' => 'required',

        ]);

        if($validator->fails()){
            return response()->json([
            'success' => false  ,
            'message' => 'validation_error',
            'errors' => $validator->errors() 
            ], 400);
        }
        $zoom = new \MacsiDigital\Zoom\Support\Entry;
         $user = new \MacsiDigital\Zoom\User($zoom);


        $zoom = new \MacsiDigital\Zoom\Support\Entry;

        $user = $zoom::user()->find('h8C3RQtHS3OAxXNCi828Lw');

        $meeting = $zoom::meeting()->make([
            'topic' => $request->topic,
            'type' => 2,
            'start_time' => new Carbon('2020-07-30 18:20:00') ,
            'duration' => 80,
            'timezone' => 'Africa/Cairo',
            'password' => '12345678',
        ]);

        
        $meeting->settings()->make([
            'join_before_host' => true,
            'approval_type' => 1,
            'registration_type' => 1,
            'enforce_login' => true,
            'waiting_room' => false,
            'mute_upon_entry' => true,
            'watermark' => false,
            'audio' => 'both',
            'auto_recording' => 'local',
            'contact_name' => 'مستر سمير'
        ]);


        $result = $user->meetings()->save($meeting);

        if($result){
            $new = Lesson::create([
                'class_year' =>  $request->class_year,
                'title' => $request->topic,
                'description' => $request->description,
                'start_url' => $result->start_url,
                'join_url' => $result->join_url,
                'start_time' => $result->start_time,
                'duration' => $result->duration
            ]);

            
            if($new) {
                $notification= [
                    'message' => 'تم أضافة الدرس',
                    'alert-type' => 'success'
                ];
            }else{
                $notification= [
                    'message' => 'حدث خطأ أثناء أضافة الدرس برجاء المحاولة مرة أخري',
                    'alert-type' => 'error'
                ];
            }
        }



        return back()->with($notification);
    }

    /**
     * Get Lessons
     */
    public function get_lessons (){
        if (\Auth::check()) {
            $class = Reservation::where('user_id' , \Auth::user()->id)->value('class_year');
            $data = Lesson::where('class_year' , $class)->get();
        }else{
            $data = Lesson::all();
        }

        return view('pages.lessons',['data' => $data ?? [] ]);
    }


    /**
     * go_to_lesson_room
     */
    public function go_to_lesson_room ($id,$title) {
        if($title){
            $lesson = Lesson::where('title' , 'like' , '%'.$title.'%')->whereId($id)->first();
        }else{
            $notification= [
                'message' => 'حدث خطأ أثناء أضافة الدرس برجاء المحاولة مرة أخري',
                'alert-type' => 'error'
            ];
        }

        return view('pages.lesson-room' , ['lesson' => $lesson])->with($notification ?? []);

    }

}
