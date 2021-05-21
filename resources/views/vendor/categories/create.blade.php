@extends('layouts.vendor')
@section('content')
  <style>
    .input-group-prepend{width:35%;}
    .input-group-text{width:100%;}
    .darkblue{background-color:darkblue;color:white}
  </style>
  <div class="content-wrapper" style="min-height: 1416.81px;">
    <div class="container bg-gradient-white card-body">
      <!-- Default form subscription -->
      <form class="text-center border border-light card  p-5 m-auto" method="POST" style="width:70%" action="{{route('vendor.categories.store')}}" enctype="multipart/form-data">
        @csrf
        <p style="text-align: left">
          <a href="{{route('vendor.categories')}}" target="_self"><i class="fa fa-angle-left "></i> Back</a>
        </p>
        <p class="h4 mb-4 p-2 card bg-blue">Add New Category</p>
        <!-- Name -->
        <div class="mb-4">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Category Name </span>
          </div>
        <input type="text" value="{{ old('name') }}" name="name" class="form-control @error('name') is-invalid @enderror">
        </div>
        @error('name')
        <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
        @enderror
      </div>

        <!-- Sign in button -->
          <div class="mb-4">
          <button class="btn btn-success btn-block mt-2" onclick="submit=true" type="submit" >Save Changes</button>

                </div>
      </form>
      <!-- Default form subscription -->
    </div>
  </div>
  <script>
      function toggle(){
          if(document.getElementById("switch").getAttribute('value')==='0'){
               document.getElementById('switch').setAttribute('value','1');
              document.getElementById('checked').setAttribute('value','1');
          }else{
              document.getElementById('switch').setAttribute('value','0')
              document.getElementById('checked').setAttribute('value','0')}
      }
  </script>
  @endsection