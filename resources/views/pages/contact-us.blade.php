@extends('index')

@section('content')
    <!-- ##### Regular Page Area Start ##### -->
    <section class="regular-page-area section-padding-50-0 d-flex " 
             style="background-image: url({{asset('images/core-img/texture.png')}});flex:1 ">        
      <div class="container">
            <div class="row">
                <div class="col-12 text-right">
                    <div class="page-content">
                        <h4>للتواصل والأستفسارات</h4>
                        <p>Sed elementum lacus a risus luctus suscipit. Aenean sollicitudin sapien neque, in fermentum lorem dignissim a. Nullam eu mattis quam. Donec porttitor nunc a diam molestie blandit. Maecenas quis ultrices ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam eget vehicula lorem, vitae porta nisi. Ut vel quam erat. Ut vitae erat tincidunt, tristique mi ac, pharetra dolor. In et suscipit ex. Pellentesque aliquet velit tortor, eget placerat mi scelerisque a. Aliquam eu dui efficitur purus posuere viverra. Proin ut elit mollis, euismod diam et, fermentum enim.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Regular Page Area End ##### -->

@include('sections.footer')
@endsection