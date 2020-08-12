@extends('index')

@section('content')
 <!-- ##### Regular Page Area Start ##### -->
@guest 
    <section class="register-now section-padding-50-0 d-flex " 
             style="background-image: url({{asset('images/core-img/texture.png')}});flex:1  ">
      <div class="container wow fadeInUp" data-wow-delay="400ms">
          <div class="row">
              <div class="col-12 text-right">
                  <div class="page-content">
                      <h4></h4>
                      <p>برجاء إنشاء حساب أولا لكي يمكنك الحجز عند المدرس</p>

                      <div class="form-group row mt-4 mb-0">
                        <a class="btn btn-primary" style="text-decoration: underline" href="{{route('register')}}"> إنشاء حساب جديد</a>
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
@endguest


@auth

    @if(Auth::user()->role !== 'Normal')
          <!-- ##### Regular Page Area Start ##### -->
    <section class="register-now section-padding-50-0 d-flex " 
             style="background-image: url({{asset('images/core-img/texture.png')}});flex:1  ">
        <div class="container wow fadeInUp" data-wow-delay="400ms">
         <div class="row mb-4 fadeInUp">
            <h3 class="text-primary">طلبات الحجز الجديدة ({{count(@$data)}}) </h3>
        </div>
         <table class="fadeInUp" id="table" data-toggle="table">
            <thead>
              <tr>
                <th>الاسم </th>
                <th> رقم موبايل الطالب</th>
                <th> عنوان الطالب</th>
                <th> وظيفة ولي الامر</th>
                <th>رقم موبايل ولي الامر</th>
                <th>الصف الدراسي</th>
                <th> ميعاد الدرس</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
               @forelse($data as $item)
               <tr style="text-align: right">
                  <td>{{$item->name}}</td>
                  <td>{{$item->mobile}}</td>
                  <td>{{$item->address}}</td>
                  <td>{{$item->guardianـjob}}</td>
                  <td>{{$item->guardianـmobile}}</td>
                  <td>{{$item->class_year == 1 ? 'الصف الأول' :
                      ($item->class_year == 2 ? 'الصف الثاني - أدبي' :
                      ($item->class_year == 3 ? 'الصف الثاني - علمي':(
                       $item->class_year == 4 ? 'الصف الثاني - ميكانيا' : (
                       $item->class_year == 5 ? 'الصف الثالث ' :  'إحصاء' )
                       )
                      ))
                      }}</td>
            
                    <td>{{$item->appointment == 0 ? 'لم يتم إختيار الميعاد' : (
                        $item->appointment == 1 ? '٣ - ٥ مساءا' :($item->appointment == 2 ? ' ٧ - ٩ مساءا' : ' ٥ - ٧ مساءا'
                    )) }} 
                    </td>

                  <td style="display: flex ; justify-content: center; align-items: center">
                     <a href="{{route('accept-reservation',$item->id)}}">
                        <img style="width : 35px" src={{asset('images/accept.svg')}} >
                    </a>
                     <a class="mr-3" href="{{route('reject-reservation',$item->id)}}">
                         <img style="width : 40px" src={{asset('images/reject.svg')}} >
                    </a>
                  </td>
               </tr>
              @empty 
              @endforelse
            </tbody>
          </table>
        </div>
    </section>

    @else
        <!-- ##### Register Now Start ##### -->
        <section class="register-now section-padding-50-0 d-flex " 
                style="background-image: url({{asset('images/core-img/texture.png')}});flex:1  ">
                <!-- Register Now Countdown -->
                <div class="register-now-countdown mb-100  wow fadeInUp"  
                    data-wow-delay="500ms"
                    style="align-self:center">
                    <img style="height:400px;width:100%" src="{{asset('images/reservationForm.svg')}}" />
                </div> 
                <!-- Register Contact Form -->
                <div class="register-contact-form mb-100 wow fadeInUp" data-wow-delay="250ms">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="forms">
                                <h4 style="text-align :center">الحجز عند المدرس</h4>
                                <form action="{{route('send-reservation')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="name" placeholder="الاسم رباعي" type="text" class="form-control 
                                        @error('name') is-invalid 
                                        @enderror" name="name" value="{{ old('name') }}" required >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
        
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input id="mobile" placeholder="رقم موبايل الطالب" 
                                                type="text" class="form-control 
                                        @error('mobile') is-invalid 
                                        @enderror" name="mobile" value="{{ old('mobile') }}" required >
                                        @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                            <input id="address" placeholder="عنوان السكن" 
                                                    type="text" class="form-control 
                                            @error('address') is-invalid 
                                            @enderror" name="address" value="{{ old('address') }}" required >
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class=" row">

                                <div class="col-md-6">
                                    <input id="guardianـjob" placeholder="وظيفة ولي الأمر" 
                                            type="text" class="form-control 
                                    @error('guardianـjob') is-invalid 
                                    @enderror" name="guardianـjob" value="{{ old('guardianـjob') }}" required >
                                    @error('guardianـjob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                        <input id="guardianـmobile" placeholder="رقم موبايل ولي الأمر" 
                                                type="text" class="form-control 
                                        @error('guardianـmobile') is-invalid 
                                        @enderror" name="guardianـmobile" value="{{ old('guardianـmobile') }}" required >
                                        @error('guardianـmobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <select name="class_year" class="form-control" required>
                                            <option disabled selected  @error('class_year') is-invalid 
                                            @enderror" value="{{ old('class_year') }}">أختر الصف الدراسي</option>
                                            <option value="1">الصف الأول الثانوي</option>
                                            <option value="2">الصف الثاني الثانوي - أدبي</option>
                                            <option value="3">الصف الثاني الثانوي - علمي </option>
                                            <option value="4">الصف الثاني الثانوي - ميكانيا </option>
                                            <option value="5">الصف الثالث الثانوي </option>
                                            <option value="6">إحصاء</option>
                                        </select>
                                        @error('class_year')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select name="appointment" class="form-control" required>
                                            <option disabled selected  @error('appointment') is-invalid 
                                            @enderror" value="{{ old('appointment') }}">أختر ميعاد الدرس الخاص بك</option>
                                            <option value="1">3 - 5 مساءا</option>
                                            <option value="2">5 - 7 مساءا</option>
                                            <option value="3">7 - 9 مساءا</option>
                                        </select>
                                        @error('appointment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                        <div class="col-md-8 align-center offset-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __(' ارسال طلب الحجز الأن') }}
                                            </button>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endauth
    <!-- ##### Regular Page Area End ##### -->

@include('sections.footer')
@endsection