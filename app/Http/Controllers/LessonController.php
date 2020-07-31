<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson ;
use App\Attendance;
use App\Reservation;
use App\Assignment;

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

        $user = $zoom::user()->find('h8C3RQtHS3OAxXNCi828Lw');

        $date = new Carbon($request->start_time_date . $request->start_time_time) ;

        $meeting = $zoom::meeting()->make([
            'topic' => $request->topic,
            'type' => 2,
            'start_time' => $date,
            'duration' => 90,
            'password' => '12345678',
        ]);

        
        $meeting->settings()->make([
            'join_before_host' => true,
            'participant_video' => false,
            'close_registeration' => true,
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
                'start_time' => Carbon::parse($result->start_time)->addHour(2),
                'duration' => $result->duration
            ]);

            if ($request->hasFile('assignments')) {
                $files   = $request->file('assignments');
                foreach($files as $file){
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $new->id."-".date('his') .".".$extension;
                    $folderpath  = 'uploads/assignments'.'/';
                    $file->move($folderpath , $fileName);
                    $assignment = Assignment::create([
                        'lesson_id' => $new->id,
                        'url' => url('/') . '/' .$folderpath. $fileName
                    ]);
                }
            }
            
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
            if(\Auth::user()->role == 'Admin' || \Auth::user()->role == 'MR'){
                $data = Lesson::orderBy('class_year','desc')->get();

            }else{
                $class = Reservation::where('user_id' , \Auth::user()->id)->value('class_year');
                $data = Lesson::where('class_year' , $class)->get();
            }
        }else{
        }

        return view('pages.lessons',['data' => $data ]);
    }


    /**
     * go_to_lesson_room
     */
    public function go_to_lesson_room ($id,$title) {
        if($title){
            $lesson = Lesson::with(['assignment'])->where('title' , 'like' , '%'.$title.'%')->whereId($id)->first();
            if(\Auth::user()->role == 'Normal'){
                $now    = Carbon::now('EET');
                $isAfter = $now->greaterThan($lesson->start_time);
    
                //If lesson is available create attendance
                if($isAfter && $lesson->online == 1){
                    $isAttendedBefore = Attendance::where(['user_id' =>\Auth::user()->id , 'lesson_id' =>$lesson->id ])->exists();
                    if(!$isAttendedBefore){
                        $attend = Attendance::create([
                            'user_id' => \Auth::user()->id,
                            'lesson_id' => $lesson->id,
                            'date' => $now
                        ]);
                    }
                }
            }
        }else{
            $notification= [
                'message' => 'حدث خطأ أثناء حضور الدرس برجاء المحاولة مرة أخري',
                'alert-type' => 'error'
            ];
        }

        return view('pages.lesson-room' , ['lesson' => $lesson])->with($notification ?? []);

    }

    /**
     * Delete Lesson
     */
    public function delete_lesson ($id) {   
        $lesson = Lesson::find($id);
        $lesson->delete();

        $notification= [
            'message' => 'تم مسح الدرس',
            'alert-type' => 'success'
        ];
 
        $data = Lesson::get();

        return back()->with(['data' => $data,$notification]);
    }   


    /**
     * Upload recorded video for lesson
     * 
     */
    public function upload_lesson_video (Request $request){
        $lesson = Lesson::find($request->lesson_id);
        if($request->has('video')){
            $file = $request->video;
            $extension = $file->getClientOriginalExtension();
            $fileName = $request->lesson_id."-".date('his') .".".$extension;
            $folderpath  = 'uploads/videos'.'/';
            $file->move($folderpath , $fileName);
            $lesson->update([
                'video_url' => url('/') . '/' .$folderpath. $fileName ,
                'online' => 0
            ]);
        }

        $notification= [
            'message' => 'تم رفع فيديو الدرس',
            'alert-type' => 'success'
        ];
        return back()->with($notification);
    }

}
