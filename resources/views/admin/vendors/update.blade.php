@extends('layouts.admin')
@section('content')
  <style>
    .input-group-prepend{width:35%;}
    .input-group-text{width:100%;}
    .darkblue{background-color:darkblue;color:white}
  </style>
  <div class="content-wrapper" style="min-height: 1416.81px;">
    <div class="container bg-gradient-white card-body">
        <div class="mb-4">

      <!-- Default form subscription -->
      <form class="text-center border border-light card  p-5 m-auto" method="POST" style="width:50%" action="{{route('admin.vendors.update')}}" enctype="multipart/form-data">
        @csrf <input type="hidden" value="{{$vendor->id}}" name="id">
        <input type="hidden" value="{{$vendor->status}}" name="status">
        <input type="hidden" value="{{$vendor->logo}}" name="logo">
        <p style="text-align: left">
          <a href="{{route('admin.vendors')}}" target="_self"><i class="fa fa-angle-left "></i> Back</a>
        </p>
        <p class="h4 mb-4 p-4 bg-blue">Edit <b> {{$vendor->name}} </b> Vendor</p>
          <div class="input-group mb-2 centered">

              <img class="img-thumbnail  m-auto" style="max-width: 100px" src="{{asset("images/vendors/".$vendor->logo)}}">

          </div>
        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Name</span>
            </div>
            <input type="text" name="name" id="defaultSubscriptionFormPassword" class="form-control" value="{{$vendor->name}}">
          </div>
          @error('name')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Username</span>
            </div>
            <input type="text" name="username" id="defaultSubscriptionFormPassword" class="form-control" value="{{$vendor->username}}">
          </div>
          @error('username')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>
        <!-- Name -->
        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Mobile Number</span>
            </div>
            <input type="text" name="mobile" id="defaultSubscriptionFormPassword" class="form-control"  value="{{$vendor->mobile}}">
          </div>
          @error('mobile')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">E-mail </span>
            </div>
            <input type="text" name="email" id="defaultSubscriptionFormPassword" class="form-control" value="{{$vendor->email}}">
          </div>
          @error('email')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>
         <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">SSN </span>
            </div>
            <input type="text" name="ssn" id="defaultSubscriptionFormPassword" class="form-control" value="{{$vendor->ssn}}">
          </div>
          @error('ssn')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Address </span>
            </div>
            <input type="text" name="address" id="pac-input" class="form-control" value="{{$vendor->address}}">
          </div>
          @error('address')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>
        <!-- Sign in button -->
        <button class="btn btn-success btn-block mt-2" type="submit">Save Changes</button>


      </form>
      <!-- Default form subscription -->  </div>
    </div>
  </div>

@endsection