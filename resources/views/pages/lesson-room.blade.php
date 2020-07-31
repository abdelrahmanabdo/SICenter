@extends('index')

@section('content')
    <!-- ##### Regular Page Area Start ##### -->
    <section class="regular-page-area mt-3   d-flex " 
             style="background-image: url({{asset('images/core-img/texture.png')}});flex:1 ">              
        <div class="container">
            <iframe 
                    style="border:none;" 
                    width="100%" 
                    height="100%" 
                    src={{Auth::user()->role == 'MR' ? $lesson->start_url : $lesson->join_url}} 
                    allow="microphone; camera; fullscreen"> 
            </iframe>
        </div>
    </section>
    <!-- ##### Regular Page Area End ##### -->

@endsection