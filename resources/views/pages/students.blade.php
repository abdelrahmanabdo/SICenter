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
         <div class="row mb-4">
            <h3 class="text-primary"> قائمة كل الطلاب  ({{count(@$data)}})</h3>
         </div>
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
              </tr>
            </thead>
            <tbody>
               @forelse($data as $item)
               <tr data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"  style="text-align: right">
                  <td>{{$item->user->id}}</td>
                  <td>{{$item->details->name}}</td>
                  <td>{{$item->user->mobile}}</td>
                  <td>{{$item->details->mobile}}</td>
                  <td>{{$item->details->guardian_job}}</td>
                  <td>{{$item->details->guardianـmobile}}</td>
                  <td>{{$item->details->class_year == 1 ? 'الصف الأول' :($item->details->class_year == 2 ? 'الصف الثاني' : 'الصف الثالث')}}</td>
                  <td>{{$item->user->is_subscribed  == 1? 'نعم' : 'لا'}}</td>
               </tr>
              @empty 
              @endforelse
            </tbody>
          </table>
        </div>
    </section>


@include('sections.footer')
@endsection