@extends('layouts.vendor')
@section('content')

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
        <h2 class=" card card-header white-text text-center mx-3 bg-blue"> Your Categories</h2>

      <!--/Card image-->

      <div class="px-4">


        <div class="table-wrapper">
            <a href="{{route('vendor.categories.create')}}" class="float-right btn bg-green text-bold mt-3" style="font-size: 18px;">+ Add New Category</a>
          <!--Table-->
          <table id="dtBasicExample" class="table table-hover mb-0">
            <!--Table head-->
            <thead>
            <tr>

              <th class="th-lg">Category Name<i class="fas fa-sort ml-1"></i></th>
              <th class="th-lg">Actions<i class="fas fa-sort ml-1"></i></th>
            </tr>
            </thead>
            <!--Table head-->

            <!--Table body-->
            <tbody>
            @if(isset($categories))
              @foreach($categories as $category)
            <tr deletedid="{{$category->id}}">
              <td>{{$category->name}}</td>
              <td> <div>
                  <a href="{{route('vendor.categories.edit',$category->id)}}" class="btn btn-outline-white btn-rounded btn-sm px-2" style="color:#007bff;">
                    <i class="fas fa-pencil-alt mt-0"></i>
                  </a>
                  <a href="{{route('vendor.categories.delete')}}" deleteid="{{$category->id}}" class="productdelete"  style="color:red;">
                    <i class="fa fa-trash-alt mt-0"></i>
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

        $(document).on('click','.productdelete',function (e) {
            e.preventDefault();
                if(confirm('Are You Sure To Delete This Category !')) {
                $.ajax({
                    type: 'get',
                    url: '{{route('vendor.categories.delete')}}',
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
