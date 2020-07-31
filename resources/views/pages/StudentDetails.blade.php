@extends('index')
@section('content')
    <!-- ##### Regular Page Area Start ##### -->
    <section class=" section-padding-50-0 d-flex " 
             style="background-image: url({{asset('images/core-img/texture.png')}});flex:1 ">        
      <div class="container">
           <a class="btn btn-danger" href="{{route('student.delete',$data->id)}}">
            مسح الطالب
           </a>
           <div class="row">
            <div class="col-12 text-right">
            <h5 class="my-3">بيانات حساب الطالب</h5>
               <div class="page-content">
                  <form action="{{route('user.update',$data->user->id)}}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="row mb-3">
                        <div class="col-md-12">
                           <label>هل دفع الإشتراك الشهر ؟</label>
                           <input id="mobile" placeholder="" type="checkbox" class="mr-4" name="is_subscribed" 
                               @if($data->user->is_subscribed == 1) checked @endif>
                        </div>
                     </div>
                     <div class="row mb-3">
                        <div class="col-md-12">
                           <input id="mobile" placeholder="رقم الموبايل  المستخدم ف تسجيل الدخول باللغة الانجليزية" type="text" class="form-control" name="mobile" 
                                  value="{{ $data->user->mobile }}" required >
                        </div>
                     </div>
                     <div class="row mb-3">
                           <div class="col-md-12">
                              <input id="password" placeholder="كلمة المرور" type="password" class="form-control" name="password" >
                           </div>
                     </div>
                     <div class="form-group row my-4">
                        <div class="col-md-8 align-center offset-md-12">
                           <button type="submit" class="btn btn-primary">
                                 {{ __(' تعديل بيانات الطالب ') }}
                           </button>
                        </div>
               </div>
            </form>  
               </div>
            </div>
           </div>
            <div class="row">
                <div class="col-12 text-right">
                   <h5 class="my-3">بيانات الطالب الشخصية</h5>
                    <div class="page-content">
                   <form action="{{route('student.update',$data->details->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                           <div class="col-md-12">
                              <input id="name" placeholder="الاسم رباعي" type="text" class="form-control" name="name" 
                                    value="{{$data->details->name}}" required >
                           </div>
                     </div>
                     <div class="row mb-3">
                           <div class="col-md-12">
                              <input id="mobile" placeholder="رقم موبايل الطالب" 
                                       type="text" class="form-control" name="mobile" value="{{$data->details->mobile}}" required >
                           </div>
                     </div>
                     <div class="row mb-3">
                           <div class="col-md-12">
                                 <input id="address" placeholder="عنوان السكن" 
                                          type="text" class="form-control" name="address" value="{{$data->details->address}}"  >
                           </div>
                     </div>
                     <div class="mb-3 row">

                     <div class="col-md-6">
                           <input id="guardianـjob" placeholder="وظيفة ولي الأمر" 
                                 type="text" class="form-control" name="guardianـjob" value="{{$data->details->guardianـjob}}"  >
                     </div>
                     <div class="col-md-6">
                              <input id="guardianـmobile" placeholder="رقم موبايل ولي الأمر" 
                                       type="text" class="form-control" name="guardianـmobile" value="{{$data->details->guardianـmobile}}"  >
                           </div>
                     </div> 
                     <div class="row">
                           <div class="col-md-12">
                              <select name="class_year" required class="form-control" >
                                 <option disabled " value="class_year" >أختر الصف الدراسي</option>
                                 <option value="1" @if($data->details->class_year == 1) selected @endif>الصف الأول الثانوي</option>
                                 <option value="2" @if($data->details->class_year == 2) selected @endif>الصف الثاني الثانوي</option>
                                 <option value="3" @if($data->details->class_year == 3) selected @endif>الصف الثالث الثانوي</option>
                              </select>
                              @error('class_year')
                                 <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                 </span>
                              @enderror
                           </div>
                     </div>
                           <div class="form-group row my-4">
                                    <div class="col-md-8 align-center offset-md-12">
                                       <button type="submit" class="btn btn-primary">
                                             {{ __(' تعديل بيانات الطالب ') }}
                                       </button>
                                    </div>
                           </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
               <div class="col-12 text-right">
                  <h5 class="my-3">حضور الطالب</h5>

                  <div class="page-content">
                     <table class="col-12" id="table" data-toggle="table">
                        <thead>
                           <tr>
                              <th> الدرس</th>
                              <th> وقت حضور الدرس</th>
                              <th>الشهر</th>
                           </tr>
                        </thead>
                        <tbody>
                           @forelse($data->user->attendance as $item)
                           <tr style="text-align: right">
                              <td>{{$item->lesson->title}}</td>
                              <td>{{$item->date}}</td>
                              <td>{{$item->created_at->format('m')}}</td>
                           </tr>
                           @empty 
                        @endforelse
                        </tbody>
                     </table>
                   </div>
               </div>
           </div>
        </div>
    </section>
    <!-- ##### Regular Page Area End ##### -->

@include('sections.footer')
@endsection