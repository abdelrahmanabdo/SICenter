<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $y1_last_lesson = Lesson::whereClassYear(1)->whereOnline(1)->orderBy('id' , 'desc')->first();
        $y2_last_lesson = Lesson::whereClassYear(2)->whereOnline(1)->orderBy('id' , 'desc')->first();
        $y3_last_lesson = Lesson::whereClassYear(3)->whereOnline(1)->orderBy('id' , 'desc')->first();

        // $y1_prev_lesson = Lesson::whereClassYear(1)->orderBy('id' , 'asc')->first();
        // $y2_prev_lesson = Lesson::whereClassYear(2)->orderBy('id' , 'asc')->first();
        // $y3_prev_lesson = Lesson::whereClassYear(3)->orderBy('id' , 'asc')->first();

        return view('pages.home',['y1_lesson' => $y1_last_lesson,
                                 'y2_lesson' => $y2_last_lesson, 
                                 'y3_lesson' => $y3_last_lesson,
                                //  'y1_prev_lesson' => $y1_prev_lesson,
                                //  'y2_prev_lesson' => $y2_prev_lesson,
                                //  'y3_prev_lesson' => $y3_prev_lesson,
                                 ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function lessons()
    {
        return view('pages.lessons');
    }

        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function lesson_reservation()
    {
        return view('pages.lesson-reservation');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact_us()
    {
        return view('pages.contact-us');
    }
    
}
