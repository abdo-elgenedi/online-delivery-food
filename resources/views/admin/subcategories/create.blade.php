@extends('layouts.admin')
@section('content')
  <style>
    .input-group-prepend{width:35%;}
    .input-group-text{width:100%;}
    .darkblue{background-color:darkblue;color:white}
  </style>
  <div class="content-wrapper" style="min-height: 1416.81px;">
    <div class="container bg-gradient-white card-body">
      <!-- Default form subscription -->
      <form class="text-center border border-light card  p-5 m-auto" method="POST" style="width:50%" action="{{route('admin.maincategories.store')}}" enctype="multipart/form-data">
        @csrf
        <p style="text-align: left">
          <a href="{{route('admin.maincategories')}}" target="_self"><i class="fa fa-angle-left "></i> Back</a>
        </p>
        <p class="h4 mb-4 p-2 card bg-blue">Add New Category To {{isset($parentname)?$parentname:''}}</p>
        @if(getActiveLanguages()->count() >0)
          @foreach(getActiveLanguages() as $index=> $lang)
        <div class="mb-4">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text bg-blue" id="inputGroup-sizing-default"> Language Shortcut </span>
          </div>
         <input type="text" class="form-control" readonly="readonly" name="category[{{$index}}][abbr]" value="{{$lang->abbr}}">
        </div>
        @error('category.index.abbr')
        <span class="card bg-red mt-1" role="alert">
            <strong>This Field Is Required</strong>
          </span>
        @enderror
      </div>
        <!-- Name -->
        <div class="mb-4">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Category Name </span>
          </div>
        <input type="text" name="category[{{$index}}][name]" id="defaultSubscriptionFormPassword" class="form-control"placeholder="Example (Clothes) مثال ملابس">
        </div>
        @error('category.index.name')
        <span class="card bg-red mt-1" role="alert">
            <strong>This Field Is Required</strong>
          </span>
        @enderror
      </div>
        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Status </span>
            </div>
            <div class="p-1 pl-5" >
              <div class="switchToggle">
                <input name="category[{{$index}}][active]" checked value="1" type="checkbox" id="switch{{$index}}" hidden>
                <label for="switch{{$index}}">Toggle</label>
              </div>
            </div>
          </div>
          @error('category.index.active')
          <span class="card bg-red mt-1" role="alert">
            <strong>This Field Is Required</strong>
          </span>
          @enderror
        </div>
          @endforeach
        @endif
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
        <button class="btn btn-success btn-block mt-2" type="submit">Save Changes</button>

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