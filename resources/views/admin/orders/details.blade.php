
    <style>
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
                        <div class="row m-1">
                            <div class="col-md-6">
                                <p>Order No. <span>{{$invoice->id}}</span></p>
                                <p>Customer: <span>{{$invoice->customer->name}}</span></p>
                                <p>Restaurant: <span>{{$invoice->vendor->name}}</span></p>
                                <p>Time: <span>{{$invoice->created_at->format('D, d M y')}} {{$invoice->created_at->format('h:i A')}}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p>Address: <span>{{\App\Models\City::find($invoice->vendor->city_id)->name}} ــ {{\App\Models\State::find($invoice->vendor->state_id)->name}}</span></p>
                                <p>{{$invoice->address}}</p>
                                <p>Mobile: <span>{{$invoice->customer->mobile}}</span></p>
                            </div>
                        </div>
                        <div class="row table-row m-1">
                            <table class="col-md-12 table table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width:5%">#</th>
                                    <th style="width:50%">Item</th>
                                    <th class="text-right" style="width:15%">Quantity</th>
                                    <th class="text-right" style="width:15%">Unit Price</th>
                                    <th class="text-right" style="width:15%">Total Price</th>
                                </tr>
                                </thead>
                                <tbody class="p-1"><?php $index=0 ?>
                                @foreach($invoice->orders as $order)
                                    <tr class="p-1">
                                        <td class="text-center">{{++$index}}</td>
                                        <td>{{\App\Models\Product::find($order->product_id)->name}}</td>
                                        <td class="text-right">{{$order->quantity}}</td>
                                        <td class="text-right">{{$order->product->price}} EGP</td>
                                        <td class="text-right">{{($order->product->price)*($order->quantity)}} EGP</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="m-2">
                            <p >Subtotal : {{$invoice->total_price-$invoice->vendor->delivery_fees}} EGP</p>
                            <p >Service Charges : {{$invoice->vendor->delivery_fees}} EGP</p>
                            <p >Total : {{$invoice->total_price}} EGP</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

