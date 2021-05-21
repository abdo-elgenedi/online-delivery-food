@extends('layouts.customer')
@section('content')
<section style="min-height: 800px">
    <div id="details">

    </div>
    <div class="container">
        <div class="row pt-5">
            @if(isset($orders)&&$orders->count()>0)
                @foreach($orders as $order)
            <div class=" card col-md-5 m-2" >
                <div id="{{$order->id}}" class="order row" style="cursor: pointer">
                    <div class="col-md-3">
                        <img class="m-1 pt-2" width="100" height="100" src="{{asset('images/vendors/'.$order->vendor->logo)}}" alt="">
                    </div>
                    <div class="col-md-7 m-1">
                        <h5 style="color: blue">{{$order->vendor->name}}</h5>
                        <p>Time: <small>{{$order->created_at->format('D, d M y')}} {{$order->created_at->format('h:i A')}}</small></p>
                        <p>Order id: {{$order->id}} <strong style="color:@if($order->status==1) gold @elseif($order->status==2) blue @elseif($order->status==3) green @endif" class="pl-4">@if($order->status==1) Pending @elseif($order->status==2) Prepared @elseif($order->status==3) On The way @endif</strong></p>
                    </div>
                </div>
                <div class="row"><div class="col-md-8"></div>
                <button id="{{$order->id}}" class="align- tracking btn btn-primary col-md-3 p-1 m-1" style="border-radius: 1px">Track Order</button>
                </div>
            </div>
                @endforeach
                @else
                <div class="col-md-12 card align-center m-5 p-5">
                    <h2 class="text-center">Sorry you don't have any orders to show</h2>
                </div>
            @endif
        </div>
    </div>
</section>

<script>
    window.onload=function () {
        $(document).on('click','.order',function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '{{route('order.details')}}',
                data: {
                    'id': $(this).attr('id'),
                    '_token':'{{csrf_token()}}'
                },
                success: function (data) {
                    if(data.type=='success') {
                        $('#details').html('').html(data.view);
                        $('#detailsmodal').modal('show');

                    }
                },
                error: function (reject) {

                }
            })
        });

        $(document).on('click','.tracking',function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: '{{route('order.tracking')}}',
                data: {
                    'id': $(this).attr('id'),
                    '_token':'{{csrf_token()}}'
                },
                success: function (data) {
                    if(data.type=='success') {
                        $('#details').html('').html(data.view);
                        $('#detailsmodal').modal('show');

                    }
                },
                error: function (reject) {

                }
            })
        });
    }

</script>
    @endsection



