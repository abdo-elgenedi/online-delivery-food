@extends('layouts.admin')
@section('content')


  <div class="content-wrapper bg-white pt-1" style="min-height: 1416.81px;">
      @if(Session::has('success'))
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
    <div class="container bg-gradient-white pt-4">
    <!-- Table with panel -->
    <div class="card card-cascade narrower">

      <!--Card image-->
        <h2 class=" card card-header white-text text-center mx-3 bg-blue">Main Categories</h2>


      <!--/Card image-->

      <div class="px-4">

        <div class="table-wrapper">
            <a href="{{route('admin.maincategories.create')}}" class="float-right btn bg-green text-bold mt-3" style="font-size: 18px;">+ Add New Main Category</a>
          <!--Table-->
          <table id="dtBasicExample" class="table table-hover mb-0">
            <!--Table head-->
            <thead>
            <tr>

              <th class="th-lg">Category Name<i class="fas fa-sort ml-1"></i></th>
                <th class="th-lg">Language<i class="fas fa-sort ml-1"></i></th>
              <th class="th-lg">Status<i class="fas fa-sort ml-1"></i></th>
                <th class="th-lg">Photo</th>
              <th class="th-lg">Actions<i class="fas fa-sort ml-1"></i></th>
            </tr>
            </thead>
            <!--Table head-->

            <!--Table body-->
            <tbody>
            @if(isset($mainCategories))
              @foreach($mainCategories as $mainCategory)
            <tr>
              <td>{{$mainCategory->name}}</td>
                <td>{{$mainCategory->translation_lang}}</td>
            @if($mainCategory->active=='0')<td style="color:red">Not Active</td>
                @elseif($mainCategory->active=='1')<td style="color:green">Active</td> @endif

                <td><img src="{{asset('images/maincategories/'.$mainCategory->photo)}}" alt="Category" width="40" height="40" class="img-circle"></td>
              <td> <div>
                  <a href="{{route('admin.maincategories.edit',$mainCategory->id)}}" class="btn btn-outline-white btn-rounded btn-sm px-2" style="color:#007bff;">
                    <i class="fas fa-pencil-alt mt-0"></i>
                  </a>
                  <a href="{{route('admin.maincategories.delete',$mainCategory->id)}}" onclick="if(!confirm('Do You Want To Delete Category \'{{$mainCategory->name}}\' ?'))return false" style="color:red;">
                    <i class="far fa-trash-alt mt-0"></i>
                  </a>
                  <a href="{{route('admin.maincategories.changeStatus',$mainCategory->id)}}" class="btn btn-@if($mainCategory->active=='0')primary @elseif($mainCategory->active=='1')danger @endif  btn-sm px-2" style="color:white;">
                        @if($mainCategory->active=='0')Activate
                         @elseif($mainCategory->active=='1')Deactivate @endif
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
      window.onload = function(){
          document.getElementById('success').click();
      }

      $(document).ready(function () {
          $('#dtBasicExample').DataTable({
              "pagingType": "full " // "simple" option for 'Previous' and 'Next' buttons only
          });
          $('.dataTables_length').addClass('bs-select');
      });


  </script>
    <script>

    </script>
@endsection
