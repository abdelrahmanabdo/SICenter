@extends('index')

@section('content')
    <!-- ##### Regular Page Area Start ##### -->
    <section class="register-now section-padding-50-0 d-flex" 
             style="background-image: url({{asset('images/core-img/texture.png')}});flex:1  ">  
     @auth      
      @if(auth()->user()->role == 'Admin' || auth()->useR()->role == 'Mr')
      <div class="container wow fadeInUp" data-wow-delay="400ms" >
         <diV style="display: flex;justify-content : space-between">
            <div class="row mb-4">
               <h3 class="text-primary"> قائمة الدروس ({{isset($data) ? count($data) : 0}})</h3>
            </div>
            <div>
               <a class="mr-3 btn btn-primary" href="#modal" rel="modal:open">أضف درس جديد</a>
            </div>
         </diV>
         <table class="col-12" id="table" data-toggle="table">
            <thead>
              <tr>
                <th>الصف الدراسي</th>
                <th> عنوان الدرس</th>
                <th>  وصف قصير للدرس</th>
                <th>لينك الحصة الأونلاين</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
               @forelse(@$data as $item)
               <tr style="text-align: right">
                  <td> {{$item->class_year == 1 ? 'الصف الأول' :
                        ($item->class_year == 2 ? 
                        'الصف الثاني' : 'الصف الثالث')}}
                  </td>
                  <td>{{$item->title}}</td>
                  <td>{{$item->description}}</td>
                  <td><a href="{{route('lesson-room',['id'=>$item->id , 'title'=>$item->title])}}">لينك الحصة </a></td>
                  <td style="display:flex;flex-direction:column ; justify-content: center; align-items: center">
                     <a href="#"><img style="width : 25px" src={{asset('images/edit.svg')}} ></a>
                     <a class="mr-3" href="{{route('lesson-delete',$item->id)}}"><img style="width : 25px" src={{asset('images/delete.svg')}} ></a>
                  </td>
               </tr>
              @empty 
              @endforelse
            </tbody>
          </table>
        </div>
        @else 
            @if(auth()->user()->role == 'Normal' && auth()->user()->is_subscribed == 0)
                <section class="register-now section-padding-50-0 d-flex " 
                        style="background-image: url({{asset('images/core-img/texture.png')}});flex:1  ">
                <div class="container wow fadeInUp" data-wow-delay="400ms">
                    <div class="row">
                        <div class="col-12 text-right">
                            <div class="page-content">
                                <h4></h4>
                                <p>لا يمكنكك مشاهدة الدروس بدون دفع المبلغ الشهري وتأكيد ذلك مع المدر</p>

                                <div class="form-group row mt-4 mb-0">
                                    <a class="btn btn-primary" style="text-decoration: underline" href="{{route('register')}}"> إنشاء حساب جديد</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </section>
            @else 

            @endif
        @endif
      @endauth
      @guest
        <section class="register-now section-padding-50-0 d-flex " 
                style="background-image: url({{asset('images/core-img/texture.png')}});flex:1  ">
        <div class="container wow fadeInUp" data-wow-delay="400ms">
            <div class="row">
                <div class="col-12 text-right">
                    <div class="page-content">
                        <h4></h4>
                        <p>لا يمكنكك مشاهدة الدروس بدون ان تكون طالب عند المستر</p>

                        <div class="form-group row mt-4 mb-0">
                            <a class="btn btn-primary" style="text-decoration: underline" href="{{route('register')}}"> إنشاء حساب جديد</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
      @endguest
    </section>
    <!-- Modal -->
      <div id="modal" class="modal">
         <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               {{-- <a href="#" class="text-danger" rel="modal:close">الغاء</a> --}}

                <div class="forms my-4">
                    <h4 style="text-align :center " class="mb-4">أضافة درس</h4>
                    <form action="{{route('add-lesson')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12">
                    <select name="class_year" class="form-control" required>
                        <option disabled selected  @error('class_year') is-invalid 
                        @enderror" value="{{ old('class_year') }}">أختر الصف الدراسي</option>
                        <option value="1">الصف الأول الثانوي</option>
                        <option value="2">الصف الثاني الثانوي</option>
                        <option value="3">الصف الثالث الثانوي</option>
                    </select>
                    @error('class_year')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <input id="topic" placeholder="عنوان الدرس" type="text" class="form-control 
                            @error('topic') is-invalid 
                            @enderror" name="topic" value="{{ old('topic') }}" required >
                            @error('topic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <textarea id="description"class="form-control"  
                                      name="description" value="{{ old('description') }}" placeholder="وصف قصير للدرس" required ></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <input id="start_time" placeholder="وقت الحصة" type="datetime-local" class="form-control 
                            @error('start_time') is-invalid 
                            @enderror" name="start_time" value="{{ old('start_time') }}" required >
                            @error('start_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex flex-column align-items-center">
                            <label class="align-right my-3">صور الواجب الخاص بالدرس</label>
                            <input id="assignments" type="file" class="form-control" name="assignments[]" >
                        </div>
                    </div>
                    <div class="form-group row my-4">
                            <div class="col-md-8 align-center offset-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __(' أضافة درس ') }}
                                </button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
         </div>
      </div>
    <!-- -->

    


@include('sections.footer')

@endsection
{{-- 
<script>
   
   $("#modal").modal({
      showClose: false
   });
</script> --}}