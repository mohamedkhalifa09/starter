@extends('layouts.app')


@section("content")
<div class="container" style="width:50%">
<div class="flex-center position-ref full-height">
  <div class="content">
      <div class="title m-b-md text-center" style="font-size: 50px">
          {{__("messages.Add your offer")}}

      </div>
     @if(Session::has("success"))
      <div class="alert alert-success" role="alert">
          {{Session::get("success")}}
        </div>
        @endif
      <br>
      <form method="POST" action="" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
             
            {{-- <input type="_token" value="{{csrf_token()}}" style="display: hidden"> --}}
          <label class="text-center" style="font-size: 17px" for="exampleInputEmail1">{{__("messages.Offer Photo")}}</label>
          <input type="file" class="form-control" name="photo" aria-describedby="emailHelp" placeholder='{{__("messages.Enter Offer Photo")}}'>
          @error('photo')
          <div class="alert alert-danger mt-1" role="alert">
            {{$message}}
          </div>
          @enderror
          {{-- <small  class="form-text text-danger">We'll never share your email with anyone else.</small> --}}
        </div>
          <div class="form-group">
             
              {{-- <input type="_token" value="{{csrf_token()}}" style="display: hidden"> --}}
            <label style="font-size: 17px" for="exampleInputEmail1">{{__("messages.Offer Name")}}</label>
            <input type="text" class="form-control" name="name_en" aria-describedby="emailHelp" placeholder='{{__("messages.Enter Offer Name")}}'>
            @error('name_en')
            <div class="alert alert-danger mt-1" role="alert">
              {{$message}}
            </div>
            @enderror
            {{-- <small  class="form-text text-danger">We'll never share your email with anyone else.</small> --}}
          </div>
          <div class="form-group">
             
              {{-- <input type="_token" value="{{csrf_token()}}" style="display: hidden"> --}}
            <label style="font-size: 17px" for="exampleInputEmail1">{{__("messages.Arabic Offer Name")}}</label>
            <input type="text" class="form-control" name="name_ar" aria-describedby="emailHelp" placeholder='{{__("messages.Enter Arabic Offer Name")}}'>
            @error('name_ar')
            <div class="alert alert-danger mt-1" role="alert">
              {{$message}}
            </div>
            @enderror
            {{-- <small  class="form-text text-danger">We'll never share your email with anyone else.</small> --}}
          </div>
          <div class="form-group">
            <label style="font-size: 17px" for="exampleInputPassword1">{{__("messages.Offer Price")}}</label>
            <input type="text" class="form-control" name="price" placeholder='{{__("messages.Enter Offer Price")}}'>
            @error('price')
            <div class="alert alert-danger mt-1" role="alert">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="form-group">
              <label style="font-size: 17px" for="exampleInputPassword1">{{__("messages.Arabic Offer Details")}}</label>
              <input type="text" class="form-control" name="details_ar" placeholder='{{__("messages.Enter Arabic Offer Details")}}'>
               @error('details_ar')
              <div class="alert alert-danger mt-1" role="alert">
                {{$message}}
              </div>
              @enderror
            </div>
            <div class="form-group">
              <label class="text-center" style="font-size: 17px" for="exampleInputPassword1">{{__("messages.Offer Details")}}</label>
              <input type="text" class="form-control" name="details_en" placeholder='{{__("messages.Enter Offer Details")}}'>
               @error('details_en')
              <div class="alert alert-danger mt-1" role="alert">
                {{$message}}
              </div>
              @enderror
            </div>
          {{-- <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div> --}}
          <button id="save_offer" class="btn btn-primary">{{__("messages.Save Offer")}}</button>
        </form>


  </div>
</div>
</div>
@stop
@section("script")
<script>
$(document).on("click","#save_offer",function(e){
  e.preventDefault();
  $.ajax({
type:"post",
url:"{{route('ajax.offer.store')}}",
data:{
  "_token" : "{{csrf_token()}}",
  // "photo" : $("input[name='photo']").val(),
  "name_ar" : $("input[name='name_ar']").val(),
  "name_en" : $("input[name='name_en']").val(),
  "price" : $("input[name='price']").val(),
  "details_ar" : $("input[name='details_ar']").val(),
  "details_en" : $("input[name='details_en']").val(),

},
});
});





</script>

@stop