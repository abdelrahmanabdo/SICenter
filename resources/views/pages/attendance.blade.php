@extends('index')

@section('content')
    <!-- ##### Regular Page Area Start ##### -->
    <section class="regular-page-area section-padding-50-0 d-flex " 
             style="background-image: url({{asset('images/core-img/texture.png')}});flex:1 ">        
             <div class="container wow fadeInUp" data-wow-delay="400ms" >
               <diV style="display: flex;justify-content : space-between">
                  <div class="row mb-4">
                     <h3 class="text-primary"> حضور الدروس ({{isset($data) ? count($data) : 0}})</h3>
                  </div>
               </diV>
               <table class="col-12" id="table" data-toggle="table">
                  <thead>
                     <tr>
                        <th> الدرس</th>
                        @if(\Auth::user()->role == 'Admin' || \Auth::user()->role == 'Mr')
                           <th> إسم الطالب </th>
                        @endif
                        <th> وقت حضور الدرس</th>
                        <th>الشهر</th>
                      </tr>
                    </thead>
                    <tbody>
                       @forelse($data as $item)
                       <tr style="text-align: right">
                          <td>{{$item->lesson->title}}</td>
                          @if(\Auth::user()->role == 'Admin' || \Auth::user()->role == 'Mr')
                          <td>{{$item->user->student->details->name}}</td>
                          @endif
                          <td>{{$item->date}}</td>
                          <td>{{$item->created_at->format('m')}}</td>
                       </tr>
                      @empty 
                    @endforelse
                  </tbody>
                </table>
              </div>
    </section>
    <!-- ##### Regular Page Area End ##### -->

@include('sections.footer')
@endsection