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
      <form class="text-center border border-light card  p-5 m-auto" method="POST" style="width:70%" action="{{route('vendor.products.store')}}" enctype="multipart/form-data">
        @csrf
        <p style="text-align: left">
          <a href="{{route('vendor.products')}}" target="_self"><i class="fa fa-angle-left "></i> Back</a>
        </p>
        <p class="h4 mb-4 p-2 card bg-blue">Add New Product</p>
        <!-- Name -->
        <div class="mb-4">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Product Name </span>
          </div>
        <input type="text" value="{{ old('name') }}" name="name" class="form-control @error('name') is-invalid @enderror">
        </div>
        @error('name')
        <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
        @enderror
      </div>

          <!-- Description -->
          <div class="mb-4">
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Description </span>
                  </div>
                  <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Choose Your Description Carefully It Will appeared To The Customers">{{@old('description')}}</textarea>
              </div>
              @error('description')
              <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
              @enderror
          </div>
          <div class="mb-4">
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Your Category </span>
                  </div>
                  <select id="sub_category" name="sub_category" class="form-control @error('sub_category') is-invalid @enderror">
                      <option value="{{null}}">Select Your Category</option>
                      @foreach($restCategories as $restCategory)
                          <option {{@old('category_id')==$restCategory->id? 'selected':''}} value="{{$restCategory->id}}">{{$restCategory->name}}</option>
                      @endforeach
                  </select>
              </div>
              @error('sub_category')
              <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
              @enderror
          </div>

        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Price </span>
            </div>
            <input type="number" value="{{ old('price') }}" step=".01" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter Price After Any Discount">
          </div>
          @error('price')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Status </span>
            </div>
            <div class="p-1 pl-5" >
                <div class="custom-switch">
                    <input type="checkbox" name="status" value="1"  class="custom-control-input " id="customSwitch10" checked>
                    <label class="custom-control-label" for="customSwitch10">Choose status</label>
                </div>
            </div>
          </div>
          @error('status')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>

          <div class="mb-4">
              <div class="input-group">
                  <div class="input-group">
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" id="inputGroupFile01" name="photo"
                                 aria-describedby="inputGroupFileAddon01">
                          <label class="custom-file-label text-left" for="inputGroupFile01" >Upload Category Photo</label>
                      </div>
                  </div>
              </div>
              @error('photo')
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