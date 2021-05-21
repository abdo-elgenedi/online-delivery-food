@extends('layouts.customer')
@section('content')
    <section class="services py-5" id="" style="min-height: 830px">
        <div class="container bootstrap snippets bootdeys">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default invoice" id="invoice">
                        <div class="panel-body">
                            <hr>
                            <div class="row">

                                <div class="col-md-6 from">
                                    <p class="lead marginbottom text-primary">From : {{Auth::user()->name}}</p>
                                    <p>{{$vendor->city->name}} - {{$vendor->state->name}}</p>
                                    <p>{{$cart['address']}}</p>
                                    <p>Phone: {{Auth::user()->mobile}}</p>
                                    <p>Email: {{Auth::user()->email}}</p>
                                    <p>Notes: {{$cart['note']}}</p>
                                </div>

                                <div class="col-md-6 to">
                                    <p class="lead marginbottom text-primary">To : {{$vendor->name}}</p>
                                    <p>{{$vendor->city->name}} - {{$vendor->state->name}}</p>
                                    <p>Phone: {{$vendor->mobile}}</p>
                                    <p>Email: {{$vendor->email}}</p>

                                </div>

                            </div>

                            <div class="row table-row">
                                <table class="col-md-10 table table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width:5%">#</th>
                                        <th style="width:50%">Item</th>
                                        <th class="text-right" style="width:15%">Quantity</th>
                                        <th class="text-right" style="width:15%">Unit Price</th>
                                        <th class="text-right" style="width:15%">Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $index=0 ?>
                                    @foreach($cart['items'] as $item)
                                    <tr>
                                        <td class="text-center">{{++$index}}</td>
                                        <td>{{$item['name']}}</td>
                                        <td class="text-right">{{$item['qnty']}}</td>
                                        <td class="text-right">{{$item['price']}} EGP</td>
                                        <td class="text-right">{{$item['total']}} EGP</td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                            <div class="row">
                                    <p class="col-md-3">Subtotal : {{$cart['subtotal']}} EGP</p>
                                    <p class="col-md-3">Service Charges : {{$cart['charges']}} EGP</p>
                                    <p class="col-md-3">Total : {{$cart['total']}} EGP</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6 margintop">


                                    <a href="{{route('order')}}" class="btn btn-success" id="invoice-print"> Order Now</a>
                                    <a href="{{route('menu.rests',$vendor->id)}}" class="btn btn-danger"><i class="fa fa-envelope-o"></i> Cancel</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection