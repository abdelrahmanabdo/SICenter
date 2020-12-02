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
        $mechanics_last_lesson = Lesson::whereClassYear(4)->whereOnline(1)->orderBy('id' , 'desc')->first();
        $statistics_last_lesson = Lesson::whereClassYear(5)->whereOnline(1)->orderBy('id' , 'desc')->first();

        return view('pages.home',['y1_lesson' => $y1_last_lesson,
                                 'y2_lesson' => $y2_last_lesson, 
                                 'y3_lesson' => $y3_last_lesson,
                                 'mechanics_lesson' => $mechanics_last_lesson,
                                 'statistics_lesson' => $statistics_last_lesson,
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