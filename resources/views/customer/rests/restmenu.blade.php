@extends('layouts.customer')
@section('content')
 {{--$restaurants->appends(\request()->query())->links()--}}

 <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 2000">
     <form action="{{route('checkout')}}" method="post">
         @csrf
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form>
                     <div class="form-group">
                         <label for="recipient-name" class="col-form-label">Address Details:</label>
                         <input type="text" name="address" class="form-control" id="recipient-name" placeholder="example: mehwar st - building:2 - floor:4 - flat:30" required>
                     </div>
                     <div class="form-group">
                         <label for="message-text" class="col-form-label">Special rquest:</label>
                         <textarea class="form-control" name="note" id="message-text" placeholder="example: make the sandwich spicy without ketchup" required></textarea>
                     </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-success">Checkout</button>
             </div>
         </div>
     </div>
     </form>
 </div>
 <section style="min-height: 650px">
  <div class="container">
   <div class="mt-5" style="min-height: 50px"></div>
   <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
     <span class="pr-2">you are searching in : </span>
     <li class="breadcrumb-item">{{isset($vendor->city)?$vendor->city->name:''}}</li>
     <li class="breadcrumb-item active" aria-current="page">{{isset($vendor->state)?$vendor->state->name:''}}</li>
     <span class="pl-3"><a href="{{route('welcome')}}">Change Location</a></span>
    </ol>
   </nav>
   <div class="row p-2" style="border: solid 1px;">
    <div class="col-md-2"><img height="150" width="150" src="{{asset('images/vendors/'.$vendor->logo)}}" alt=""></div>
    <div class="col-md-8">
     <p>{{isset($vendor->name)?$vendor->name:''}}</p>
     <p>Located at : {{isset($vendor->city)?$vendor->city->name:''}} / {{isset($vendor->state)?$vendor->state->name:''}}</p>
     <p>@if(isset($vendor->categoriesLimit)&&count($vendor->categoriesLimit)>0) @foreach($vendor->categoriesLimit as $cat) {{\App\Models\MainCategory::find($cat->category_id)->name}} .. @endforeach @endif</p>
    </div>
    <div class="col-md-2 p-5">
     <p class="p-3" style="color: @if($vendor->open_status==0) red @else green @endif;">@if($vendor->open_status==0) Closed @else Open @endif</p>
    </div>
   </div>
      <div id="alert" class="alert alert-warning alert-dismissible fade show mt-1" role="alert" style="display: none">
          <strong id="message"></strong>.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
   <div class="row pt-1" style="border: solid 1px;min-height: 1000px;">
    <div class="col-md-2">
     <div class="card p-3 mt-5 " style="position: fixed; min-height: 300px;max-width: 250px; min-width: 180px">
      <h5 class="">Categories</h5>
      @if(isset($categories))
       @foreach($categories as $category)
                 @if(isset($category->products)&&count($category->products)>0)
                 <a style="border-radius:1px;width: 100%; color: darkblue; text-transform: capitalize" href="#{{$category->id}}">{{$category->name}}</a>
                 @endif
       @endforeach
      @endif



     </div>
    </div>
    <div class="col-md-6 pt-5">
     <input type="text" id="myFilter" class="form-control mb-2" onkeyup="myFunction()" placeholder="Search in menu" style="border-radius: 1px">
     @if(isset($categories)&&$categories->count()>0)
      <div class=" p-2 pt-2" id="myItems">
        @foreach($categories as $category)
        <div class="cardbody">
            @if(isset($category->products)&&count($category->products)>0)
            <h5 class="card p-2" id="{{$category->id}}" style="background-color: #f6f6f6; text-transform: capitalize">{{$category->name}}</h5>
          @foreach($category->products as $product)
           <div class="cards">
             <div class="row">
              <div class="col-md-2">
              <img height="80" width="80" src="{{asset('images/products/'.$product->photo)}}" alt="image">
              </div>
              <div class="col-md-10">
               <div class="row">
             <p class="cardtitle col-md-6">{{$product->name}}</p>
             <p class="col-md-4">{{$product->price}} EGP</p>
                <div class="col-md-1">
             <button id="{{$product->id}}" class="add btn btn-success p-1">add</button>
                </div>
               </div>
               <div class="row">
                <small class="card-text pl-3">{{$product->description}}</small>
               </div>
              </div>
            </div>
             <hr>
           </div>
          @endforeach
         @endif
        </div>
       @endforeach
        {{-- $restaurants->links()--}}
       </div>
     @else <h3>This restaurant does not have any food</h3>
     <p>Back and choose another restaurants <a href="{{route('welcome')}}">Change Location</a></p>
     @endif
    </div>
       <div id="allcart" class="col-md-4">
         @include('customer.rests.cart')
       </div>
   </div>
  </div>
 </section>

 <script>

     window.onload=function () {
         $(document).on('click','.add',function (e) {
             e.preventDefault();
                 $.ajax({
                     type: 'post',
                     url: '{{route('cart.add')}}',
                     data: {
                         'id': $(this).attr('id'),
                         '_token':'{{csrf_token()}}'
                     },
                     success: function (data) {
                         if(data.type=='success')
                        $('#allcart').html('').html(data.data)
                         else {
                             $('#message').text(data.message);
                             $('#alert').css('display','block');
                         }
                     },
                     error: function (reject) {

                     }
                 })
         });

         $(document).on('click','#checkout',function (e) {
             e.preventDefault();
                $('#details').modal('show');
         });

         $(document).on('click','.plus',function (e) {
                     e.preventDefault();
                         $.ajax({
                             type: 'post',
                             url: '{{route('cart.plus')}}',
                             data: {
                                 'id': $(this).attr('id'),
                                 '_token':'{{csrf_token()}}'
                             },
                             success: function (data) {
                                $('#allcart').html('').html(data.data)
                             },
                             error: function (reject) {

                             }
                         })
                 });
        $(document).on('click','.minus',function (e) {
                             e.preventDefault();
                                 $.ajax({
                                     type: 'post',
                                     url: '{{route('cart.minus')}}',
                                     data: {
                                         'id': $(this).attr('id'),
                                         '_token':'{{csrf_token()}}'
                                     },
                                     success: function (data) {
                                        $('#allcart').html('').html(data.data)
                                     },
                                     error: function (reject) {

                                     }
                                 })
                         });

         $(document).on('click','#clear',function (e) {
             e.preventDefault();
             $.ajax({
                 type: 'post',
                 url: '{{route('cart.clear')}}',
                 data: {
                     '_token':'{{csrf_token()}}'
                 },
                 success: function (data) {
                     $('#allcart').html('').html(data.data)
                 },
                 error: function (reject) {

                 }
             })
         });

         $(document).on('click','.deleteitem',function (e) {
             e.preventDefault();
             $.ajax({
                 type: 'post',
                 url: '{{route('cart.deleteitem')}}',
                 data: {
                     'id': $(this).attr('id'),
                     '_token':'{{csrf_token()}}'
                 },
                 success: function (data) {
                     $('#allcart').html('').html(data.data)
                 },
                 error: function (reject) {

                 }
             })
         });
     };
         function myFunction() {
             var input, filter, cards, cardContainer, h5, title, i;
             input = document.getElementById("myFilter");
             filter = input.value.toUpperCase();
             cardContainer = document.getElementById("myItems");
             cards = cardContainer.getElementsByClassName("cards");
             for (i = 0; i < cards.length; i++) {
                 title = cards[i].querySelector(".cardbody p.cardtitle");
                 if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                     cards[i].style.display = "";
                 } else {
                     cards[i].style.display = "none";
                 }
             }
         }

 </script>
@endsection