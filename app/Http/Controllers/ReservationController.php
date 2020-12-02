<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Reservation ;
use App\User ;
use App\Student ;
class ReservationController extends Controller
{
    /**
     * Send Studen reservation
     */
    public function send_reservation (Request $request) {
        $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'mobile' => 'required',
                'address' => 'required',
                'guardianـmobile' => 'required',
                'guardianـjob' => 'required',
                'class_year' => 'required',
        ]);

        if($validator->fails()){
            return back()->with([
            'success' => false  ,
            'message' => 'validation_error',
            'errors' => $validator->errors() 
            ], 400);
        }

        $isExists = Reservation::where('user_id' ,\Auth::user()->id )->exists();

        if($isExists){
            $notification= [
                'message' => 'لقد قمت بأرسال طلب حجز من قبل لا يمكن أرسال طلبين بأنتظار تأكيده من مساعد المدرس',
                'alert-type' => 'success'
            ];
        }else{
            $new = Reservation::create([
                'user_id' => \Auth::user()->id , 
                'name' => $request->name,
                'mobile' => $request->mobile,
                'guardianـmobile' => $request->guardianـmobile,
                'guardianـjob' => $request->guardianـjob,
                'address' => $request->address,
                'class_year' => $request->class_year,
            ]);
            $notification= [
                'message' => 'تم ارسال طلب الحجز بأنتظار تأكيد الحجز من المدرس',
                'alert-type' => 'success'
            ];
        }


        return back()->with($notification);
    }

    /**
     * Get Reservations
     */
    public function get_reservations (){
        $data = Reservation::whereIsNew(1)->get();

        return view('pages.reservations',['data' => $data]);
    }


    /**
     * accept Reservations
     */
    public function accept_reservation ($id) {
        $reservation = Reservation::find($id);

        $reservation->update(['is_new' => 0 ]);
        
        //Update User 
        $user = User::whereId($reservation->user_id)->update(['is_active' => 1]);
        
        //Add New Student
        $new = Student::create([
            'user_id' => $reservation->user_id,
            'reservation_id' => $reservation->id,
        ]);

        if($new){
          $notification = [
            'message' => 'تم قبول الحجز وأضافة الطالب',
            'alert-type' => 'success'
          ];
        }else {
            $notification = [
                'message' => 'حدث خطأ أثناء قبول الطلب برجاء المحاولة مرة أخري',
                'alert-type' => 'error'
              ];
        }

        $data = Reservation::whereIsNew(1)->get();

        return view('pages.reservations',['data' => $data])->with($notification);
    }

        /**
     * accept Reservations
     */
    public function reject_reservation ($id) {
        $reservation = Reservation::find($id);
        
        $reservation->update(['is_new' => 0 ]);

        $notification = [
            'message' => 'تم رفض الحجز ',
            'alert-type' => 'success'
        ];
 
        $data = Reservation::whereIsNew(1)->get();

        return view('pages.reservations',['data' => $data])->with($notification);
    }
}