@extends('layouts.admin')
@section('content')

  <div class="content-wrapper bg-white pt-1" style="min-height: 1416.81px;">
      {{--This Modal For Deletion--}}
      <!-- Modal -->
          <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header ">
                      </div>
                      <div class="modal-body text-center bg-red">
                          <h4>Are You Sure To Delete This Record <i class="fas fa-exclamation" style="color:white"></i></h4>
                      </div>
                      <div class="modal-footer ">
                          <button type="button" class="btn btn-danger" onclick="confirmdelete()" data-dismiss="modal">Delete</button>
                          <button type="button" class="btn btn-primary" onclick="confirm='false'" data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>
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
        <h2 class=" card card-header white-text text-center mx-3 bg-blue">Cities</h2>
      <!--/Card image-->

      <div class="px-4">


        <div class="table-wrapper">
            <a href="{{route('admin.cities.create')}}" class="float-right btn bg-green text-bold mt-3" style="font-size: 18px;">+ Add New City</a>
          <!--Table-->
          <table id="dtBasicExample" class="table table-hover mb-0">
            <!--Table head-->
            <thead>
            <tr>

              <th class="th-lg">Name<i class="fas fa-sort ml-1"></i></th>
              <th class="th-lg">Actions<i class="fas fa-sort ml-1"></i></th>
            </tr>
            </thead>
            <!--Table head-->

            <!--Table body-->
            <tbody>
            @if(isset($cities))
              @foreach($cities as $city)
            <tr deletedid="{{$city->id}}">
              <td>{{$city->name}}</td>
              <td> <div>
                  <a href="{{route('admin.cities.edit',$city->id)}}" class="btn btn-outline-white btn-rounded btn-sm px-2" style="color:#007bff;">
                    <i class="fas fa-pencil-alt mt-0"></i>
                  </a>
                  <a href="{{route('admin.cities.delete')}}" deleteid="{{$city->id}}" class="citydelete"  style="color:red;">
                    <i class="far fa-trash-alt mt-0"></i>
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

        $(document).on('click','.citydelete',function (e) {
            e.preventDefault();
                if(confirm('Are You Sure To Delete This city ! that means all states in this cities will be deleted')) {
                $.ajax({
                    type: 'get',
                    url: '{{route('admin.cities.delete')}}',
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

        };


    </script>

@endsection
