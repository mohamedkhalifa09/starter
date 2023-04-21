@extends("layouts.app")
@section("content")
@if(Session::has('success'))

    <div class="alert alert-success text-center width-50">
           {{Session::get('success')}}
    </div>
    @endif
    @if(Session::has('error'))
    <div class="alert alert-danger text-center width-50">
        {{Session::get('error')}}
    </div>
@endif

<div class="alert alert-success text-center " style="display: none" id="success_msg">
    {{__("messages.Successful Deleted Offer")}}
</div>
    

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('messages.Offer Name')}}</th>
        <th scope="col">{{__('messages.Offer Price')}}</th>
        <th scope="col">{{__('messages.Offer Details')}}</th>
        <th scope="col">{{__('messages.Offer Photo')}}</th>
        <th scope="col">{{__('messages.Operation')}}</th>

      </tr>
    </thead>
    <tbody>
    @foreach($offers as $offer):
        <tr class="OfferRow{{$offer->id}}">
            <th scope="row">{{$offer->id}}</th>
            <td>{{$offer->name}}</td>
            <td>{{$offer->price}}</td>
            <td>{{$offer->details}}</td>
            <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
            <td><a style="margin-left: 10px "  href="{{url('offers/edit/'.$offer->id)}}" class="btn btn-success">{{__("messages.update")}}</a>
                <a href="{{route('offers.delete',$offer->id)}}" class="btn btn-danger ml-1">{{__("messages.Delete")}}</a>
                <a href="" id="" offer_id={{$offer->id}} class="btn btn-danger delete_btn">{{__("messages.Delete Ajax")}}</a>

           </td>
            
            
           
            
            
        </tr>
     @endforeach
  </table>

@stop
  @section("script")
  <script>
  $(document).on("click",".delete_btn",function(e){
    e.preventDefault();
    var offer_id = $(this).attr("offer_id");
    
    $.ajax({
                  type: 'post',
                  enctype: 'multipart/form-data',
                  url: "{{route('ajax.offers.delete')}}",
                  data: {
                    "_token" : "{{csrf_token()}}",
                    "id" : offer_id
                  },
                  
                  success: function (data) {
                    if (data.status == true) {
                      $("#success_msg").show();
                    }
                    $(".OfferRow"+data.id).remove();
                  },
              });
          });
  
  // data:{
  //   "_token" : "{{csrf_token()}}",
  //   // "photo" : $("input[name='photo']").val(),
  //   "name_ar" : $("input[name='name_ar']").val(),
  //   "name_en" : $("input[name='name_en']").val(),
  //   "price" : $("input[name='price']").val(),
  //   "details_ar" : $("input[name='details_ar']").val(),
  //   "details_en" : $("input[name='details_en']").val(),
  
  // },
  
  
  
  </script>
  @stop
  