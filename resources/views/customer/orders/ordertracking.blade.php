<link rel="stylesheet" href="{{asset('assets/ordertracking.css')}}">
    <style>
        p{
            color: black;
        }
    </style>
        <div class="modal fade" id="detailsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="z-index: 2000">

            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="exampleModalLongTitle">Order Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Order ID: {{$invoice->id}}</h6>
                        <article class="card">
                            <div class="card-body row">
                                <div class="col"> <strong>Estimated Delivery time:</strong> <br>{{$invoice->created_at->addMinutes($invoice->vendor->delivery_time)->format('h:i A')}}</div>
                                <div class="col"> <strong>Restaurant:</strong> <br> {{$invoice->vendor->name}} | <i class="fa fa-phone"></i> {{$invoice->vendor->mobile}} </div>
                                <div class="col"> <strong>Status:</strong> <br> <span style="color:  @if($invoice->status==1) gold @elseif($invoice->status==2) blue @elseif($invoice->status==3) green @endif">
                                         @if($invoice->status==1) Pending @elseif($invoice->status==2) Prepared @elseif($invoice->status==3) On the way @endif
                                    </span> </div>
                            </div>
                        </article>
                        <div class="track">
                            <div class="step @if($invoice->status==1||$invoice->status==2||$invoice->status==3) active @endif"> <span class="icon"> <i class="fa fa-exclamation"></i> </span> <span class="text">Waiting Restaurant</span> </div>
                            <div class="step @if($invoice->status==2||$invoice->status==3) active @endif"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Prepared</span> </div>
                            <div class="step @if($invoice->status==3) active @endif "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
                        </div>
                        <a href="{{route('current.orders')}}" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a>
                    </div>
                    </div>
                </div>
            </div>


