

          <div class="card mt-5">
              <div class="card text-center p-2" style="background-color: #ff5a00;color: #fafafa;"><h5>Your Cart</h5></div>
              @if(isset($cart)&&is_array($cart))
              <div id="cart">
                  @foreach($cart['items'] as $id=>$item)
                  <div id="{{$id}}" class="row m-1">
                      <div class="">
                          <button id="{{$id}}" class="minus btn p-0"><i style="color: orange;" class="fa fa-sm fa-minus"></i></button>
                          <label class="p-1">{{$item['qnty']}}</label>
                          <button id="{{$id}}" class="plus btn p-0"><i style="color: orange;" class="fa fa-sm fa-plus"></i></button>
                      </div>
                      <b class="col-md-6 align-middle" style="font-size: 14px;">{{$item['name']}}</b>
                      <b class="col-md-3 align-middle" style="font-size: small">{{$item['total']}} </b>
                      <button id="{{$id}}" class="deleteitem btn p-0"><i style="color: red;" class="fa fa-sm fa-trash"></i></button>
                  </div>
                  <hr>
                      @endforeach
              </div>
              <div class="card p-2" style="background-color: #f6f6f6;color: #000;">
                  <p id="subtotal">Subtotal : <span>{{$cart['subtotal']}}</span></p>
                  <p id="charges">Service Charges : <span>{{$cart['charges']}} EGP</span></p>
                  <p id="total">Total : <span>{{$cart['total']}} EGP</span></p>
                  <hr>
                  <button id="checkout" class="btn" style="border-radius: 1px;background-color: green; color: #fafafa;"><h5>Checkout</h5></button>
                  <button id="clear" class="btn btn-danger" style="border-radius: 1px;">Delete All Items</button>
              </div>
              @else
                  <div class="text-center pt-5 pb-5">
                  <h2>Empty Card</h2>
                  </div>
              @endif
          </div>
