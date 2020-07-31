@extends('index')

@section('content')
   <!-- ##### Register Now Start ##### -->
   <section class="register-now section-padding-50-0 d-flex " 
            style="background-image: url({{asset('images/core-img/texture.png')}});flex:1">
        <!-- Register Now Countdown -->
        <div class="register-now-countdown mb-100  wow fadeInUp"  
             data-wow-delay="500ms"
             style="align-self:center">
            <img style="height:350px;width : 100%" src="{{asset('images/loginForm.svg')}}" />
        </div> 
          <!-- Register Contact Form -->
        <div class="register-contact-form mb-100 wow fadeInUp" data-wow-delay="250ms">
         <div class="container-fluid">
            <div class="row">
                  <div class="col-12">
                     <div class="forms">
                        <h4 style="text-align :center"> تسجيل الدخول</h4>
                        <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="mobile" placeholder="رقم الموبايل (*********01)" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>
                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" placeholder="كلمة المرور" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-12">

                                    <button type="submit" class="btn active">
                                        {{ __('تسجيل دخول') }}
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row mt-5 mb-0">
                                <a style="text-decoration: underline" href="{{route('register')}}">ليس لديك حساب ؟ انشاء حساب جديد</a>
                            </div>
                        </form>
                     </div>
                  </div>
            </div>
         </div>
      </div>


   </section>
@endsection