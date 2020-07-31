@extends('index')

@section('content')
    <!-- ##### Regular Page Area Start ##### -->
    <section class="regular-page-area mt-3 d-flex " 
             style="background-image: url({{asset('images/core-img/texture.png')}});flex:1 ">              
        <div class="container">
            <iframe 
                    style="border:none;" 
                    width="100%" 
                    height="100%" 
                    src={{Auth::user()->role == 'MR' ? $lesson->start_url : $lesson->join_url}} 
                    allow="microphone; camera; fullscreen"> 
            </iframe>
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

                    @endforelse
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ##### Regular Page Area End ##### -->

@endsection