<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
// */
// Route::get('/login',function () {
//     return view('pages.login');
// })->name('login');

Auth::routes();


/**
 * Home Page
 */
Route::get('/', 'HomeController@index')->name('home');

Route::get('/lessons', 'HomeController@lessons')->name('lessons');



Route::get('/lesson-reservation', 'HomeController@lesson_reservation')->name('lesson-reservation');

Route::get('/contact-us', 'HomeController@contact_us')->name('contact-us');


/**
 * Reservation
 */
Route::post('/reservations' , 'ReservationController@send_reservation')->name('send-reservation');
Route::get('/reservations', 'ReservationController@get_reservations')->name('reservations');
Route::get('/reservations/accept/{id}' , 'ReservationController@accept_reservation')->name('accept-reservation');
Route::get('/reservations/reject/{id}' , 'ReservationController@reject_reservation')->name('reject-reservation');


/**
 * Lessons
 */
Route::post('/lessons' , 'LessonController@add_lesson')->name('add-lesson');
Route::get('/lessons', 'LessonController@get_lessons')->name('lessons');
Route::get('/lessons/lesson-room/{id}/{title}', 'LessonController@go_to_lesson_room')->name('lesson-room');
Route::get('/lessons/{id}', 'LessonController@delete_lesson')->name('lesson-delete');



/**
 * Students 
 */
Route::post('/students', 'StudentController@add_student')->name('add-student');
Route::get('/students', 'StudentController@get_students')->name('students');



/**
 * Attendance
 */
Route::get('/attendance', 'AttendanceController@get_my_attendance')->name('attendances');


