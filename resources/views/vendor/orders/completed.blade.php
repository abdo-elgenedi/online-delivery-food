@extends('layouts.vendor')
@section('content')

    <div id="orderdetails">

    </div>
  <div class="content-wrapper bg-white pt-1" style="min-height: 1416.81px;">
      {{--This Modal For Redirection--}}
      @if(Session::has('success'))
          <button type="button" id="redirection" class="btn btn-primary" style="display: none" data-toggle="modal" data-target="#redirectionModal">
              Launch demo modal
          </button>

          <!-- Modal -->
          <div class="modal fade" id="redirectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header ">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body text-center {{Session::has('bg')?Session::get('bg'):''}}">
                          <h4>{{(Session::has('success'))?Session::get('success'):''}} <i class="fas {{(Session::has('fa'))?Session::get('fa'):''}}" style="color: {{(Session::has('color'))?Session::get('color'):''}}"></i></h4>
                      </div>
                      <div class="modal-footer ">
                          <button type="button" class="btn " data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>
      @endif
      {{--This Modal For Ajax Code--}}
      <button type="button" id="success" class="btn btn-primary" style="display: none" data-toggle="modal" data-target="#exampleModal">
          Launch demo modal
      </button>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header ">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div id="messageid" class="modal-body text-center ">
                    <h4 id="message"></h4>
                  </div>
                  <div class="modal-footer ">
                      <button type="button" class="btn " data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>

    <div class="container bg-gradient-white pt-4">
    <!-- Table with panel -->
    <div class="card card-cascade narrower">


      <!--Card image-->
        <h2 class=" card card-header white-text text-center mx-3 bg-success"> Completed Orders</h2>

      <!--/Card image-->

      <div class="px-4">


        <div class="table-wrapper">
          <!--Table-->
          <table id="dtBasicExample" class="table table-hover mb-0">
            <!--Table head-->
            <thead>
            <tr>

              <th class="th-lg">id<i class="fas fa-sort ml-1"></i></th>
              <th class="th-lg">Cust name<i class="fas fa-sort ml-1"></i></th>
              <th class="th-lg">total<i class="fas fa-sort ml-1"></i></th>
              <th class="th-lg">time<i class="fas fa-sort ml-1"></i></th>
              <th class="th-lg">status<i class="fas fa-sort ml-1"></i></th>
              <th class="th-lg">Actions<i class="fas fa-sort ml-1"></i></th>
            </tr>
            </thead>
            <!--Table head-->

            <!--Table body-->
            <tbody>
            @if(isset($invoices))
              @foreach($invoices as $invoice)
            <tr deletedid="{{$invoice->id}}">
              <td>{{$invoice->id}}</td>
              <td>{{$invoice->customer->name}}</td>
              <td>{{$invoice->total_price}} EGP</td>
              <td>{{$invoice->created_at}}</td>
              <td style="color: green;">Completed</td>
              <td> <div>
                  <a id="{{$invoice->id}}" href="{{route('vendor.orders.details')}}" class="details btn btn-outline-white btn-rounded btn-sm px-2" style="color:#007bff;">
                    <i class="fas fa-eye mt-0"></i>
                  </a>
                </div></td>
            </tr>

              @endforeach
              @endif
            </tbody>
            <!--Table body-->
          </table>
          <!--Table-->
        </div>

      </div>

    </div>
    <!-- Table with panel -->
  </div>
  </div>
  <!-- /.content-wrapper -->
  <script>
      var redirection='{{Session::has('success')?'true':false}}';
              if(redirection=='true') {
          document.getElementById('redirection').click();
      }
  </script>

      <script>
          window.onload = function(){
              $('#dtBasicExample').DataTable({
                  "pagingType": "full " // "simple" option for 'Previous' and 'Next' buttons only
              });
              $('.dataTables_length').addClass('bs-select');
          };

  </script>
    <script>
        window.onload = function(){
            var redirection='{{Session::has('success')?'true':false}}';
            if(redirection=='true') {
                document.getElementById('redirection').click();
            }

            $(document).on('click','.details',function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post',
                    url: '{{route('vendor.orders.details')}}',
                    data: {
                        'id': $(this).attr('id'),
                        '_token':'{{csrf_token()}}'
                    },
                    success: function (data) {
                        if(data.type=='success') {
                            $('#orderdetails').html('').html(data.view);
                            $('#detailsmodal').modal('show');

                        }
                    },
                    error: function (reject) {

                    }
                })
            });
    };


    </script>

@endsection
