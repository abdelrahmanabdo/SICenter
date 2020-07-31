@extends('index')
@php 
    use Carbon\Carbon;
    $now      = Carbon::now('EET');
    $lesson_time   = new Carbon($lesson->start_time);
    $isBefore = $lesson_time->greaterThan($now);
@endphp

@section('content')
    <!-- ##### Regular Page Area Start ##### -->
    <section class="regular-page-area mt-3 d-flex " 
             style="background-image: url({{asset('images/core-img/texture.png')}});flex:1 ">              
        <div class="container">
        @if($isBefore) 
            <h5 class="mb-5 text-primary text-center">لم يحن ميعاد الدرس بعد .... {{$lesson->start_time}}</h5>
        @else 
            @if($lesson->online == 0)
             @if($lesson->video_url)
                <video width="100%" height="540" oncontextmenu="return false;" controlsList="nodownload" controlsList="nopictureinpicture" controls>
                    <source src="{{$lesson->video_url}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
             @else 
                <h5 class="mb-5 text-primary text-center">لم يتم رفع تسجيل الدرس حتي الأن</h5>
             @endif
            @else 
                <iframe 
                        style="border:none;" 
                        width="100%" 
                        height="100%" 
                        src={{Auth::user()->role == 'MR' ? $lesson->start_url : $lesson->join_url}} 
                        allow="microphone; camera; fullscreen"> 
                </iframe>        
            @endif
            <div  class="my-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-heading">
                                <h3>واجب الدرس </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div>
                    @forelse($lesson->assignment as $assignment)
                        <a href="{{$assignment->url}}" download="{{$assignment->url}}">
                            <img width="340px" src="{{$assignment->url}}" />
                        </a>
                    @empty 
                      <h5 class="mb-5 text-primary text-center">لا يوجد واجب لهذا الدرس</h5>
                    @endforelse
                    </div>
                </div>
            @endif
            </div>
        </div>
    </section>
    <!-- ##### Regular Page Area End ##### -->

@endsection