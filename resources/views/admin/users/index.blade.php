@extends('layouts.admin')
@section('content')
  <div class="content-wrapper bg-white pt-1" style="min-height: 1416.81px;">
      <div class="modal fade" id="vendordetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
                      <div>
                          <div class="card bg-dark">
                              <div class="card-body pt-2">
                                  <div class="row">
                                      <div class="col-7">
                                          <h2 class=""><b class="text-cyan text-bold" id="cardname"></b></h2>
                                          <h6 class="text-bold"><b>Username: </b> <i id="cardusername"></i> </h6>
                                          <h6 class="text-bold"><b>Email: </b> <i id="cardemail"></i> </h6>
                                          <h6 class="text-bold"><b>Mobile: </b> <i id="cardmobile"></i> </h6>
                                          <h6 class="text-bold"><b>Status: </b> <b id="cardstatus"></b> </h6>
                                          <h6 class="text-bold"><b>Craeted At: </b> <i id="cardcreatedat"></i> </h6>
                                          <h6 class="text-bold"><b>Created From: </b> <i id="cardcreatedfrom"></i> </h6>
                                      </div>
                                      <div class="col-5 text-center">
                                          <img id="cardlogo" src="" alt="User Image" class="mt-3 img-circle img-fluid">
                                      </div>
                                  </div>
                              </div>
                          </div>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
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
        <h2 class=" card card-header white-text text-center mx-3 bg-blue">Users</h2>


      <!--/Card image-->

      <div class="px-4">

        <div class="table-wrapper">
            <!--Table-->
          <table id="dtBasicExample" class="table table-hover mb-0">
            <!--Table head-->
            <thead>
            <tr>

              <th class="th-lg">User Name<i class="fas fa-sort ml-1"></i></th>
                <th class="th-lg">Mobile<i class="fas fa-sort ml-1"></i></th>
                <th class="th-lg">status</th>
                <th class="th-lg">Logo</th>
                <th class="th-lg">Controls<i class="fas fa-sort ml-1"></i></th>
                <th class="th-lg">Actions<i class="fas fa-sort ml-1"></i></th>
            </tr>
            </thead>
            <!--Table head-->

            <!--Table body-->
            <tbody>
            @if(isset($users))
              @foreach($users as $user)
            <tr deletedid="{{$user->id}}">
              <td>{{$user->name}}</td>
                <td>{{$user->mobile}}</td>
                <td statusactive="{{$user->id}}" style="color: @if($user->status=='0') red @elseif($user->status=='1') green @endif">@if($user->status=='0')Blocked @elseif($user->status=='1') Active @endif</td>
                <td><img src="{{asset('images/users/'.$user->image)}}" alt="User" width="40" height="40" class="img-circle"></td>
              <td> <div>
                      <a href="{{route('admin.users.details')}}" detailstid="{{$user->id}}" data-toggle="tooltip" title="Show User Details" detailsid="{{$user->id}}" class="userdetails m-1  btn-outline-white" style="color:green;">
                          <i class="far fa-eye mt-0"></i>
                      </a>
                  </div>
              </td>
                <td>
                    <div>
                      <a href="{{route('admin.users.changeStatus')}}" activateid="{{$user->id}}" class="useractivate btn btn-@if($user->status=='0')primary @elseif($user->status=='1')danger @endif  btn-sm px-2" style="color:white;min-width: 55%;">
                          @if($user->status=='0')Activate
                          @elseif($user->status=='1')Block @endif
                      </a>
                </div>
                </td>
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
          $(function () {
              $('[data-toggle="tooltip"]').tooltip()
          });
          var redirection='{{Session::has('success')?'true':false}}';
          if(redirection=='true') {
              document.getElementById('redirection').click();
          }

          $(document).on('click','.userdelete',function (e) {
              e.preventDefault();
              if(confirm('Are You Sure To Delete This User !')) {
                  $.ajax({
                      type: 'get',
                      url: '{{route('admin.users.delete')}}',
                      data: {
                          'id': $(this).attr('deleteid')
                      },
                      success: function (data) {
                          if (data.show == true) {
                              $("#messageid").attr('class', data.bg + ' modal-body text-center ');
                              $("#message").css("color", data.color);
                              $('#message').text(data.message);
                              if (data.deleted === true) {
                                  $("[deletedid=" + data.id + "]").hide();
                              }
                              document.getElementById('success').click();
                          }
                      },
                      error: function (reject) {

                      }
                  })
              }
          });


          $(document).on('click','.useractivate',function (e) {
              var button=this;
              e.preventDefault();
              $.ajax({
                  type:'get',
                  url:'{{route('admin.users.changeStatus')}}',
                  data:{
                      'id':$(this).attr('activateid')
                  },
                  success:function (data) {
                      if(data.show==true) {
                          $("#messageid").attr('class',data.bg+' modal-body text-center ');
                          $("#message").css("color", data.color);
                          $('#message').text(data.message);
                          if(data.action) {
                              $(button).attr('class', 'btn-sm px-2 useractivate btn btn-' + data.btn);
                              $(button).text(data.action);
                              $("[statusactive=" + data.id + "]").text(data.status);
                              $("[statusactive=" + data.id + "]").css('color', data.statuscolor);
                          }
                          document.getElementById('success').click();
                      }
                  },
                  error:function (reject) {

                  }
              })
          });
          $(document).on('click','.userdetails',function (e) {
              e.preventDefault();

              $.ajax({
                  type: 'post',
                  url: '{{route('admin.users.details')}}',
                  data: {
                      'id': $(this).attr('detailsid'),
                      '_token':'{{csrf_token()}}'
                  },
                  success: function (data) {
                      if (data.show == true) {
                          $('#cardname').text(data.cardname);
                          $('#cardusername').text(data.cardusername);
                          $('#cardemail').text(data.cardemail);
                          $('#cardmobile').text(data.cardmobile);
                          $('#cardaddress').text(data.cardaddress);
                          $('#cardssn').text(data.cardssn);
                          $('#cardstatus').text(data.cardstatus).css('color',data.cardstatuscolor);
                          $('#cardcreatedat').text(data.cardcreatedat);
                          $('#cardcreatedfrom').text(data.cardcreatedfrom);
                          $('#cardlogo').attr('src','{{asset('images/vendors')}}'+'/'+ data.cardlogo);
                          $('#vendordetails').modal('show');
                      }
                  },
                  error: function (reject) {

                  }
              })
          });
      };


  </script>
@endsection
