@extends('index')
@section('content')

   <!-- ##### Hero Area Start ##### -->
   <section class="hero-area bg-img bg-overlay-2by5" style="background-image: url({{asset('images/bg-img/bg.jpg')}});">
      <div class="container h-100">
          <div class="row h-100 align-items-center">
              <div class="col-12">
                  <!-- Hero Content -->
                  <div class="hero-content text-center">
                      <h2>Let's Study Together</h2>
                      @guest
                      <a href="/reservations" class="btn clever-btn">إبدأ الأن ....</a>
                      @endguest
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- ##### Hero Area End ##### -->

  <!-- ##### Cool Facts Area Start ##### -->
  <section class="cool-facts-area section-padding-100-0">
      <div class="container">
          <div class="row">
              <!-- Single Cool Facts Area -->
              <div class="col-12 col-sm-6 col-lg-3">
                  <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="250ms">
                      <div class="icon">
                          <img src="{{asset('images/core-img/docs.png')}}" alt="">
                      </div>
                      <h2><span class="counter">1912</span></h2>
                      <h5>Success Stories</h5>
                  </div>
              </div>

              <!-- Single Cool Facts Area -->
              <div class="col-12 col-sm-6 col-lg-3">
                  <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="500ms">
                      <div class="icon">
                          <img src="{{asset('images/core-img/star.png')}}" alt="">
                      </div>
                      <h2><span class="counter">123</span></h2>
                      <h5>Dedicated Tutors</h5>
                  </div>
              </div>

              <!-- Single Cool Facts Area -->
              <div class="col-12 col-sm-6 col-lg-3">
                  <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="750ms">
                      <div class="icon">
                          <img src="{{asset('images/core-img/events.png')}}" alt="">
                      </div>
                      <h2><span class="counter">89</span></h2>
                      <h5>Scheduled Events</h5>
                  </div>
              </div>

              <!-- Single Cool Facts Area -->
              <div class="col-12 col-sm-6 col-lg-3">
                  <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="1000ms">
                      <div class="icon">
                          <img src="{{asset('images/core-img/earth.png')}}" alt="">
                      </div>
                      <h2><span class="counter">56</span></h2>
                      <h5>Available Courses</h5>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- ##### Cool Facts Area End ##### -->

  <!-- ##### Popular Courses Start ##### -->
  <section class="popular-courses-area section-padding-100-0" style="background-image: url({{asset('images/core-img/texture.png')}});">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="section-heading">
                      <h3>الدروس القادمة</h3>
                  </div>
              </div>
          </div>
          <div class="row justify-content-center">
            @if($y1_lesson || $y2_lesson || $y3_lesson)
              <!-- Single Popular Course -->
              @if($y1_lesson)
              <div class="col-12 col-md-6 col-lg-4">
                  <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="250ms">
                    <img style="height :170px"  src="{{asset('images/one.svg')}}" alt="">
                    <!-- Course Content -->
                    <div class="course-content ">
                        <span class="float-right" >{{$y1_lesson->title}}</span>
                        <div class="">
                            <p>{{$y1_lesson->start_time}}</p>
                        </div>
                        <p class="d-flex justify-content-center">{{$y1_lesson->description}}</p>
                    </div>
                       <!-- Seat Rating Fee -->
                       <div class="seat-rating-fee d-flex justify-content-between">
                        @auth
                            @if(auth()->user()->is_subscribed == 1)
                                <div  class="seat-rating h-100 d-flex align-items-center">
                                    <a class="date" href="{{route('lesson-room',['id'=>$y1_lesson->id , 'title'=>$y1_lesson->title])}}">الذهاب الي الدرس الأن</a>
                                </div>
                                <div class="course-fee h-100">
                                    <a style="display:flex;justify-content:center" 
                                        href="{{route('lesson-room',['id'=>$y1_lesson->id , 'title'=>$y1_lesson->title])}}">
                                        <img style="width:27px" src="{{asset('images/go.svg')}}" />
                                    </a>
                                </div>
                            @else 
                                <span class="mt-2 mr-2">لم يتم دفع الاشتراك الشهري لكي يمكنك الحضور</span>
                            @endif
                          @endauth
                          @guest 
                          <span class="mt-2 mr-2">يجب أن تكون طالب عن المستر لكي يمكنك الحضور</span>
                          @endguest
                      </div> 
                  </div>
              </div>
              @endif
              <!-- Single Popular Course -->
              @if($y2_lesson)
              <div class="col-12 col-md-6 col-lg-4">
                  <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="500ms">
                    <img style="height :170px"  src="{{asset('images/two.svg')}}" alt="">
                    <!-- Course Content -->
                    <div class="course-content ">
                        <span class="float-right" >{{$y2_lesson->title}}</span>
                        <div class="">
                            <p>{{$y2_lesson->start_time}}</p>
                        </div>
                        <p class="d-flex justify-content-center">{{$y2_lesson->description}}</p>
                    </div>
                    <!-- Seat Rating Fee -->
                       <div class="seat-rating-fee d-flex justify-content-between">
                          @auth
                            @if(auth()->user()->is_subscribed == 1)
                                <div  class="seat-rating h-100 d-flex align-items-center">
                                    <a class="date" href="{{route('lesson-room',['id'=>$y2_lesson->id , 'title'=>$y2_lesson->title])}}">الذهاب الي الدرس الأن</a>
                                </div>
                                <div class="course-fee h-100">
                                    <a style="display:flex;justify-content:center" 
                                        href="{{route('lesson-room',['id'=>$y2_lesson->id , 'title'=>$y2_lesson->title])}}">
                                        <img style="width:27px" src="{{asset('images/go.svg')}}" />
                                    </a>
                                </div>
                            @else 
                                <span class="mt-2 mr-2">لم يتم دفع الاشتراك الشهري لكي يمكنك الحضور</span>
                            @endif
                          @endauth
                          @guest 
                          <span class="mt-2 mr-2">يجب أن تكون طالب عن المستر لكي يمكنك الحضور</span>
                          @endguest
                      </div> 
                  </div>
              </div>
              @endif
              <!-- Single Popular Course -->
              @if($y3_lesson)
              <div class="col-12 col-md-6 col-lg-4">
                  <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="750ms">
                      <img style="height :170px" src="{{asset('images/three.svg')}}" alt="">
                      <!-- Course Content -->
                      <div class="course-content ">
                        <span class="float-right" >{{$y3_lesson->title}}</span>
                        <div class="">
                            <p>{{$y3_lesson->start_time}}</p>
                        </div>
                        <p class="d-flex justify-content-center">{{$y3_lesson->description}}</p>
                    </div>
                      <!-- Seat Rating Fee -->
                       <div class="seat-rating-fee d-flex justify-content-between">
                           @auth
                            @if(auth()->user()->is_subscribed == 1)
                                <div  class="seat-rating h-100 d-flex align-items-center">
                                    <a class="date" href="{{route('lesson-room',['id'=>$y3_lesson->id , 'title'=>$y3_lesson->title])}}">الذهاب الي الدرس الأن</a>
                                </div>
                                <div class="course-fee h-100">
                                    <a style="display:flex;justify-content:center" 
                                        href="{{route('lesson-room',['id'=>$y3_lesson->id , 'title'=>$y3_lesson->title])}}">
                                        <img style="width:27px" src="{{asset('images/go.svg')}}" />
                                    </a>
                                </div>
                            @else 
                                <span class="mt-2 mr-2">لم يتم دفع الاشتراك الشهري لكي يمكنك الحضور</span>
                            @endif
                          @endauth
                        @guest 
                        <div style="display:flex;justify-content:center">
                            <span class="mt-2 mr-2">يجب أن تكون طالب عن المستر لكي يمكنك الحضور</span>
                        </div>
                        @endguest
                      </div> 
                  </div>
              </div>
              @endif
              @else 
                <h5 class="mb-5 text-primary">لا يوجد دروس حتي الأن</h5>
              @endif
          </div>
      </div>
  </section>
  <!-- ##### Popular Courses End ##### -->
{{-- 
  <!-- ##### Popular Courses Start ##### -->
  <section class="blog-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>الدروس السابقة</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Single Popular Course -->
            @if($y1_prev_lesson)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="250ms">
                  <img style="height :170px"  src="{{asset('images/one.svg')}}" alt="">
                  <!-- Course Content -->
                  <div class="course-content ">
                      <span class="float-right" >{{$y1_prev_lesson->title}}</span>
                      <div class="">
                          <p>{{$y1_prev_lesson->start_time}}</p>
                      </div>
                      <p class="d-flex justify-content-center">{{$y1_prev_lesson->description}}</p>
                  </div>
                     <!-- Seat Rating Fee -->
                     <div class="seat-rating-fee d-flex justify-content-between">
                          @auth
                            @if(auth()->user()->is_subscribed == 1)
                                <div  class="seat-rating h-100 d-flex align-items-center">
                                    <a class="date" href="{{route('lesson-room',['id'=>$y1_lesson->id , 'title'=>$y1_lesson->title])}}">الذهاب الي الدرس الأن</a>
                                </div>
                                <div class="course-fee h-100">
                                    <a style="display:flex;justify-content:center" 
                                        href="{{route('lesson-room',['id'=>$y1_lesson->id , 'title'=>$y1_lesson->title])}}">
                                        <img style="width:27px" src="{{asset('images/go.svg')}}" />
                                    </a>
                                </div>
                            @else 
                                <span class="mt-2 mr-2">لم يتم دفع الاشتراك الشهري لكي يمكنك الحضور</span>
                            @endif
                          @endauth
                        @guest 
                            <span class="mt-2 mr-2">يجب أن تكون طالب عن المستر لكي يمكنك الحضور</span>
                        @endguest
                    </div> 
                </div>
            </div>
            @endif
            <!-- Single Popular Course -->
            @if($y2_prev_lesson)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="500ms">
                  <img style="height :170px"  src="{{asset('images/two.svg')}}" alt="">
                  <!-- Course Content -->
                  <div class="course-content ">
                      <span class="float-right" >{{$y2_prev_lesson->title}}</span>
                      <div class="">
                          <p>{{$y2_prev_lesson->start_time}}</p>
                      </div>
                      <p class="d-flex justify-content-center">{{$y2_prev_lesson->description}}</p>
                  </div>
                  <!-- Seat Rating Fee -->
                     <div class="seat-rating-fee d-flex justify-content-between">
                           @auth
                            @if(auth()->user()->is_subscribed == 1)
                                <div  class="seat-rating h-100 d-flex align-items-center">
                                    <a class="date" href="{{route('lesson-room',['id'=>$y2_prev_lesson->id , 'title'=>$y2_prev_lesson->title])}}">الذهاب الي الدرس الأن</a>
                                </div>
                                <div class="course-fee h-100">
                                    <a style="display:flex;justify-content:center" 
                                        href="{{route('lesson-room',['id'=>$y2_prev_lesson->id , 'title'=>$y2_prev_lesson->title])}}">
                                        <img style="width:27px" src="{{asset('images/go.svg')}}" />
                                    </a>
                                </div>
                            @else 
                                <span class="mt-2 mr-2">لم يتم دفع الاشتراك الشهري لكي يمكنك الحضور</span>
                            @endif
                          @endauth
                        @guest 
                        <span class="mt-2 mr-2">يجب أن تكون طالب عن المستر لكي يمكنك الحضور</span>
                        @endguest
                    </div> 
                </div>
            </div>
            @endif
            <!-- Single Popular Course -->
            @if($y3_prev_lesson)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="750ms">
                    <img style="height :170px" src="{{asset('images/three.svg')}}" alt="">
                    <!-- Course Content -->
                    <div class="course-content ">
                      <span class="float-right" >{{$y3_prev_lesson->title}}</span>
                      <div class="">
                          <p>{{$y3_prev_lesson->start_time}}</p>
                      </div>
                      <p class="d-flex justify-content-center">{{$y3_prev_lesson->description}}</p>
                  </div>
                    <!-- Seat Rating Fee -->
                     <div class="seat-rating-fee d-flex justify-content-between">
                           @auth
                            @if(auth()->user()->is_subscribed == 1)
                                <div  class="seat-rating h-100 d-flex align-items-center">
                                    <a class="date" href="{{route('lesson-room',['id'=>$y3_prev_lesson->id , 'title'=>$y3_prev_lesson->title])}}">الذهاب الي الدرس الأن</a>
                                </div>
                                <div class="course-fee h-100">
                                    <a style="display:flex;justify-content:center" 
                                        href="{{route('lesson-room',['id'=>$y3_prev_lesson->id , 'title'=>$y3_prev_lesson->title])}}">
                                        <img style="width:27px" src="{{asset('images/go.svg')}}" />
                                    </a>
                                </div>
                            @else 
                                <span class="mt-2 mr-2">لم يتم دفع الاشتراك الشهري لكي يمكنك الحضور</span>
                            @endif
                          @endauth
                      @guest 
                      <div style="display:flex;justify-content:center">
                          <span class="mt-2 mr-2">يجب أن تكون طالب عن المستر لكي يمكنك الحضور</span>
                      </div>
                      @endguest
                    </div> 
                </div>
            </div>
            @endif
        </div> 
    </div>
</section> --}}
  <!-- ##### Upcoming Events End ##### -->

  {{-- <!-- ##### Blog Area Start ##### -->
  <section class="blog-area section-padding-100-0">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="section-heading">
                      <h3>From Our Blog</h3>
                  </div>
              </div>
          </div>

          <div class="row">
              <!-- Single Blog Area -->
              <div class="col-12 col-md-6">
                  <div class="single-blog-area mb-100 wow fadeInUp" data-wow-delay="250ms">
                      <img src="{{asset('images/blog-img/1.jpg')}}" alt="">
                      <!-- Blog Content -->
                      <div class="blog-content">
                          <a href="#" class="blog-headline">
                              <h4>English Grammer</h4>
                          </a>
                          <div class="meta d-flex align-items-center">
                              <a href="#">Sarah Parker</a>
                              <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                              <a href="#">Art &amp; Design</a>
                          </div>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim nulla, mollis eu metus in, sagittis</p>
                      </div>
                  </div>
              </div>

              <!-- Single Blog Area -->
              <div class="col-12 col-md-6">
                  <div class="single-blog-area mb-100 wow fadeInUp" data-wow-delay="500ms">
                      <img src="{{asset('images/blog-img/2.jpg')}}" alt="">
                      <!-- Blog Content -->
                      <div class="blog-content">
                          <a href="#" class="blog-headline">
                              <h4>English Grammer</h4>
                          </a>
                          <div class="meta d-flex align-items-center">
                              <a href="#">Sarah Parker</a>
                              <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                              <a href="#">Art &amp; Design</a>
                          </div>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim nulla, mollis eu metus in, sagittis</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section> --}}

  <!-- ##### Blog Area End ##### -->
  @include('sections.footer')
@endsection