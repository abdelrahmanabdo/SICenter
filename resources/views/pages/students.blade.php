@extends('index')

@section('content')
    <!-- ##### Regular Page Area Start ##### -->
    <section class="register-now section-padding-50-0 d-flex" 
             style="background-image: url({{asset('images/core-img/texture.png')}});flex:1  ">        

    <!-- Modals -->
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">New message</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <form>
                 <div class="form-group">
                   <label for="recipient-name" class="col-form-label">Recipient:</label>
                   <input type="text" class="form-control" id="recipient-name">
                 </div>
                 <div class="form-group">
                   <label for="message-text" class="col-form-label">Message:</label>
                   <textarea class="form-control" id="message-text"></textarea>
                 </div>
               </form>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary">Send message</button>
             </div>
           </div>
         </div>
       </div>
       <!-- -->
      <div class="container wow fadeInUp" data-wow-delay="400ms" >
         <diV style="display: flex;justify-content : space-between">
            <div class="row mb-4">
               <h3 class="text-primary"> قائمة الطلاب ({{isset($data) ? count($data) : 0}})</h3>
            </div>
            <div>
               <a class=" btn btn-primary" href="#modal" rel="modal:open">أضف طالب جديد</a>
            </div>
         </diV>
         <table class="col-12" id="table" data-toggle="table">
            <thead>
              <tr>
                <th> كود الطالب</th>
                <th>إسم الطالب</th>
                <th> الموبايل المستخدم في الدخول</th>
                <th>رقم الموبايل</th>
                <th> وظيفة  ولي الأمر</th>
                <th>رقم موبايل ولي الأمر</th>
                <th>الصف الدراسي</th>
                <th> دفع هذا الشهر ؟</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
               @forelse($data as $item)
                  <tr data-href="http://myspace.com" style="text-align: right">
                     <td>{{$item->id}}</td>
                     <td>{{$item->details->name}}</td>
                     <td>{{$item->user->mobile}}</td>
                     <td>{{$item->details->mobile}}</td>
                     <td>{{$item->details->guardianـjob}}</td>
                     <td>{{$item->details->guardianـmobile}}</td>
                     <td>{{$item->details->class_year == 1 ? 'الصف الأول' :($item->details->class_year == 2 ? 'الصف الثاني' : 'الصف الثالث')}}</td>
                     <td>{{$item->user->is_subscribed  == 1? 'نعم' : 'لا'}}</td>
                     <td>
                        <a  href="{{route('student.details',$item->id)}}"><img style="width : 40px" src={{asset('images/view.svg')}} ></a>

                     </td>
                  </tr>
              @empty 
              @endforelse
            </tbody>
          </table>
        </div>
    </section>
    <!-- Modal -->
    <div id="modal" class="modal">
      <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            {{-- <a href="#" class="text-danger" rel="modal:close">الغاء</a> --}}

             <div class="forms my-4">
                 <h4 style="text-align :center " class="mb-4">أضافة طالب</h4>
                 <form action="{{route('add-student')}}" method="post" enctype="multipart/form-data">
                 @csrf
                 <div class="row mb-3">
                  <div class="col-md-12">
                      <input id="mobile" placeholder="رقم الموبايل باللغة الانجليزية" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>
                      @error('mobile')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-md-12">
                      <input id="password" placeholder="كلمة المرور" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="row mb-3">
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
           <div class="row mb-3">
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
           <div class="row mb-3">
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
           <div class="mb-3 row">

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
                   <select name="class_year" required class="form-control" >
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
                 <div class="form-group row my-4">
                         <div class="col-md-8 align-center offset-md-12">
                             <button type="submit" class="btn btn-primary">
                                 {{ __(' أصف طالب ') }}
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