@extends('layouts.admin')
@section('content')
  <style>
    .input-group-prepend{width:35%;}
    .input-group-text{width:100%;}
    .darkblue{background-color:darkblue;color:white}
  </style>
  <?php $index=0?>
  <div class="content-wrapper" style="min-height: 1416.81px;">
    <div class="container bg-gradient-white card-body">

      <form class="text-center border border-light card  p-5 m-auto"style="width:50%;" method="POST" action="{{route('admin.categorieslevel1.update')}}" enctype="multipart/form-data">
        @csrf
        <p style="text-align: left">
          <a href="{{route('admin.categorieslevel1')}}" target="_self"><i class="fa fa-angle-left "></i> Back</a>
        </p>
        <p class="h4 mb-4 p-2 card bg-blue">Update {{$category->name}}</p>
        <div class="mb-4">
          <div class="input-group mb-2 centered">

            <img class="img-thumbnail  m-auto" style="max-width: 100px" src="{{asset("images/maincategories/".$category->photo)}}">

          </div>



          <div class="">
            <div class="card">

              <div class="card-content">
                <div class="card-body">
                  <ul class="nav  nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" id="base-{{$category->translation_lang}}" data-toggle="tab" aria-controls="{{$category->translation_lang}}" href="#{{$category->translation_lang}}" aria-expanded="true">{{$category->translation_lang}}</a>
                    </li>
                    @if($category->categories)
                      @foreach($category->categories as $cat)
                        <li class="nav-item">
                          <a class="nav-link " id="base-{{$cat->translation_lang}}" data-toggle="tab" aria-controls="{{$cat->translation_lang}}" href="#{{$cat->translation_lang}}" aria-expanded="false">{{$cat->translation_lang}}</a>
                        </li>
                      @endforeach
                    @endif
                  </ul>
                  <div class="tab-content px-1 pt-1">
                    <div role="tabpanel" class="tab-pane active" id="{{$category->translation_lang}}" aria-expanded="true" aria-labelledby="base-{{$category->translation_lang}}">
                      <input type="hidden" name="category[{{$index}}][id]" value="{{$category->id}}">
                      <div class="mb-4">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text bg-blue" id="inputGroup-sizing-default"> Language </span>
                          </div>
                          <input type="text" class="form-control" readonly="readonly" name="category[{{$index}}][abbr]" value="{{$category->translation_lang}}">
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
                          <input type="text" name="category[{{$index}}][name]" id="defaultSubscriptionFormPassword" class="form-control"value="{{$category->name}}">
                        </div>
                        @error('category.index.name')
                        <span class="card bg-red mt-1" role="alert">
                            <strong>This Field Is Required</strong>
                        </span>
                        @enderror
                      </div>

                    </div>
                    @if($category->categories)
                      @foreach($category->categories as $cat)
                        <?php $index++?>
                        <input type="hidden" name="category[{{$index}}][id]" value="{{$cat->id}}">
                        <div class="tab-pane" id="{{$cat->translation_lang}}" aria-labelledby="base-{{$cat->translation_lang}}">
                          <div class="mb-4">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-blue" id="inputGroup-sizing-default"> Language </span>
                              </div>
                              <input type="text" class="form-control" readonly="readonly" name="category[{{$index}}][abbr]" value="{{$cat->translation_lang}}">
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
                              <input type="text" name="category[{{$index}}][name]" id="defaultSubscriptionFormPassword" class="form-control"value="{{$cat->name}}">
                            </div>
                            @error('category.index.name')
                            <span class="card bg-red mt-1" role="alert">
                              <strong>This Field Is Required</strong>
                            </span>
                            @enderror
                          </div>

                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="mb-4">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Main Category Name </span>
              </div>
              <select name="maincategory" class="form-control">
                @foreach($categories as $main)
                  <option {{$category->parent_id==$main->id?'selected':''}} value="{{$main->id}}">{{$main->name}}</option>
                @endforeach
              </select>
            </div>
            @error('category.index.name')
            <span class="card bg-red mt-1" role="alert">
                        <strong>This Field Is Required</strong>
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
          <button class="btn btn-success btn-block mt-2" type="submit">Save Changes</button>

        </div>
      </form>

      <!-- Default form subscription -->

      <!-- Default form subscription -->  </div>
  </div>
  <script>

  </script>
  @endsection