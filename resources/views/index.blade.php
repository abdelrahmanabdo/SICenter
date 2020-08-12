<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 4 meta tags *Must* come first in the head; any other head content must come *after* these tags -->
    
        <!-- Title -->
        <title>SICenter</title>
    
        <!-- Favicon -->
        <link rel="icon" href="{{asset('images/core-img/favicon.ico')}}">
    
        <!-- Stylesheet -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" type="text/css" 
              href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/components/modal/">
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

        <style>
            @font-face{font-family:Tajawal-Medium;font-style:normal;font-weight:400;src:url(fonts/Tajawal-Medium.ttf) format('truetype')}@font-face{font-family:cairo;font-style:normal;font-weight:400;src:url(fonts/Cairo-Regular.ttf) format('truetype')}
        </style>
    </head>
<body style="display: flex ; flex-direction : column;@if(\Request::route()->getName() != 'login' &&  \Request::route()->getName() != 'register'  )  justify-content : space-between @endif">
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header-area d-flex justify-content-between align-items-center">
            <!-- Contact Info -->
            <div class="contact-info">
                <a href="#"><span> رقم الموبايل :</span>01124690038</a>
                <!-- <a href="#"><span>البريد  الإلكتروني :</span> info@clever.com</a> -->
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="clever-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <!-- Menu -->
                <nav class="classy-navbar   justify-content-between" id="cleverNav">
                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>
                    <!-- Logo -->
                    <a class="nav-brand" href="/"><img style="width:250px" src="{{asset('images/core-img/logo4.png')}}" alt="">
                    </a>

                    <!-- Menu -->
                    <div class="classy-menu ">

                        <!-- Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul style="align-self: flex-start">
                                <li><a href="/">الرئيسية</a></li>
                                @auth
                                  @if(Auth::user()->role !== 'Normal')
                                    <li><a href="{{route('reservations')}}">طلبات الحجز</a></li>
                                    <li><a href="{{route('students')}}">الطلاب</a></li>
                                    <li><a href="{{route('lessons')}}">الدروس</a></li>
                                     <li><a href="{{route('attendances')}}">الحضور</a></li>

                                  @endif
                                  @if(Auth::user()->role == 'Normal')
                                    <li><a href="{{route('lessons')}}">الدروس</a></li>
                                    <li><a href="{{route('attendances')}}">الحضور</a></li>
                                  @endif

                                @endauth
                                @if(@Auth::user()->role != 'Admin' && @Auth::user()->is_active != 1)
                                    <li><a href="{{route('reservations')}}">الحجز عند المدرس</a></li>
                                @endif
                                <li><a href="{{route('contact-us')}}">للتواصل والأستفسارات</a></li>

                            </ul>

                        </div>
                    </div>

                    <div></div>
                    <div></div>
                    <div></div>
                    @guest
                    <!-- Register / Login -->
                        <div style="align-self: center">
                            @if(\Request::route()->getName() != 'login')
                                <div class="register-login-area">
                                    <a href="{{route('login')}}" class="btn active">تسجيل دخول</a>
                                </div>
                            @endif
                        </div>
                    @endguest
                    @auth
                    <!-- Register / Login -->
                        <div style="align-self: center">
                            @if(\Request::route()->getName() != 'login')
                                <form action="{{route('logout')}}" method="POST" class="register-login-area">
                                @csrf
                                    <button type="submit" class="btn active">تسجيل خروج</button>
                                </form>
                            @endif
                        </div>
                    @endauth
            <!-- Nav End -->     
            <div></div>

                </nav>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    @yield('content')



    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.js"></script>
    <!-- ##### Regular Page Area End ##### -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.js"></script>
         <!-- Modal -->  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

    <script>
        $('#table').bootstrapTable({
             pagination: true,
             search: true,
             detailViewAlign: 'right',
             locale:'ar-EG',
        })
        
    </script>



    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{asset('js/jquery/jquery-2.2.4.min.js')}}"></script>
    <!-- Popper js -->
    <script src="{{asset('js/bootstrap/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- All Plugins js -->
    <script src="{{asset('js/plugins/plugins.js')}}"></script>
    <!-- Active js -->
    <script src="{{asset('js/active.js')}}"></script> 
    <!-- Toast -->  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

    <script>
        @if(@Session::has('message'))
          var type = "{{ Session::get('alert-type', 'info') }}";
          toastr.options.progressBar = true;

          switch(type){
              case 'info':
                  toastr.info("{{ Session::get('message') }}");
                  break;
              
              case 'warning':
                  toastr.warning("{{ Session::get('message') }}");
                  break;
      
              case 'success':
                  toastr.success("{{ Session::get('message') }}");
                  break;
      
              case 'error':
                  toastr.error("{{ Session::get('message') }}");
                  break;
          }
        @endif

        $('document').ready(function(){
                $("#mobile").keypress(function(event){
                    var ew = event.which;
                    if(ew == 32)
                        return true;
                    if(48 <= ew && ew <= 57)
                        return true;
                    if(65 <= ew && ew <= 90)
                        return true;
                    if(97 <= ew && ew <= 122)
                        return true;
                    alert('برجاء إدخال رقم الموبايل باللغة الانجليزية')
                    return false;
                });

                    
        });

        $(function() {
                // Multiple images preview in browser
                var imagesPreview = function(input, placeToInsertImagePreview) {

                    if (input.files) {
                        var filesAmount = input.files.length;

                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();

                            reader.onload = function(event) {
                                $($.parseHTML('<img width="70px;border-radius:8px" class="mr-2">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                            }

                            reader.readAsDataURL(input.files[i]);
                        }
                    }

                };

                $('#files').on('change', function() {
                    $('div.gallery').empty()
                    imagesPreview(this, 'div.gallery');
                });
            });
    
      </script>

</body>
</html>