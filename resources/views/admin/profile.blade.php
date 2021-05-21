@extends('layouts.admin')
@section('content')
  <div class="content-wrapper bg-white">
    <div class="container pt-4">
      <div class="row my-2">
        <div class="col-lg-8 order-lg-2">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
            </li>
            <li class="nav-item">
              <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Edit</a>
            </li>
          </ul>
          <div class="tab-content py-4">
            <div class="tab-pane active" id="profile">
              <h1 class="mb-3" style="font-weight: bold">Admin Profile</h1>
              <div class="row">
                <div class="col-md-12">
                @if(Session::has('success'))
                  <span class="btn btn-{{Session::get('style')}}" role="alert">
                    <strong>{{Session::get('success')}}</strong>
                  </span>
                  @endif
                  <h5 class="mt-2"> Admin Info</h5>
                  <table class="table table-sm table-hover table-striped">
                    <div class=n In-md-8">
                      <div class="card mb-3">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                              </div>
                              <p class="mb-0 text-secondary">{{Auth::user()->fullname}}</p>

                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-3">
                                <h6 class="mb-0">Username</h6>
                              </div>
                              <p class="mb-0 text-secondary">{{Auth::user()->username}}</p>
                            </div>
                            <hr>
                            <div class="row">

                              <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                              </div>
                              <p class="mb-0 text-secondary">{{Auth::user()->email}}</p>
                            </div>
                            <hr>
                            <div class="row">

                              <div class="col-sm-3">
                                <h6 class="mb-0">Mobile</h6>
                              </div>
                              <p class="mb-0 text-secondary">{{Auth::user()->phone}}</p>

                            </div>
                            <hr>
                            <div class="row">

                              <div class="col-sm-3">
                                <h6 class="mb-0">address</h6>
                              </div>
                              <p class="mb-0 text-secondary">{{Auth::user()->address}}</p>

                            </div>
                            <hr>
                            <div class="row">

                              <div class="col-sm-3">
                                <h6 class="mb-0">Birthday</h6>
                              </div>
                              <p class="mb-0 text-secondary">{{Auth::user()->dob->toFormattedDateString()}}</p>

                            </div>
                            <hr>
                            <div class="row">

                              <div class="col-sm-3">
                                <h6 class="mb-0">Age</h6>
                              </div>
                              <p class="mb-0 text-secondary">{{Auth::user()->dob->age." years old"}}</p>

                            </div>
                            <hr>
                            <div class="row">

                              <div class="col-sm-3">
                                <h6 class="mb-0">Signed Up</h6>
                              </div>
                              <p class="mb-0 text-secondary">{{Auth::user()->created_at->toFormattedDateString()}}&emsp;<span class="alert-danger p-2">From{{" ( ".Auth::user()->created_at->diffForHumans()." ) "}}</span></p>
                            </div>
                          </div>
                      </div>
                    </div>
                  </table>
                </div>
              </div>
              <!--/row-->
            </div>
            <div class="tab-pane" id="edit">
              <form role="form" method="POST" action="{{ route('admin.updateprofile') }}">
                @csrf
                <div class="form-group row">
                  <label for="fullname" class="col-lg-3 col-form-label form-control-label">Fullname</label>
                  <div class="col-lg-9">
                    <input class="form-control" type="text" value="{{Auth::user()->fullname}}" name="fullname" id="fullname" required>
                    @error('fullname')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="username" class="col-lg-3 col-form-label form-control-label">Username</label>
                  <div class="col-lg-9">
                    <input class="form-control" type="text" value="{{Auth::user()->username}}" name="username" id="username" required>
                    @error('username')
                      <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-lg-3 col-form-label form-control-label">Email</label>
                  <div class="col-lg-9">
                    <input class="form-control" type="email" value="{{Auth::user()->email}}" name="email" id="email" required>
                    @error('email')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phone" class="col-lg-3 col-form-label form-control-label">Mobile</label>
                  <div class="col-lg-9">
                    <input class="form-control" type="text" value="{{Auth::user()->phone}}" name="phone" id="phone" required>
                    @error('phone')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="address" class="col-lg-3 col-form-label form-control-label">Address</label>
                  <div class="col-lg-9">
                    <input class="form-control" type="text" value="{{Auth::user()->address}}" name="address" id="address" required>
                    @error('address')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="dob" class="col-lg-3 col-form-label form-control-label">Birthday</label>
                  <div class="col-lg-9">
                    <input class="form-control" type="date" placeholder="dd-mm-yyyy" value="{{Auth::user()->dob->format('Y-m-d')}}" name="dob" id="dob" required>
                    @error('dob')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-lg-3 col-form-label form-control-label">Password</label>
                  <div class="col-lg-9">
                    <input class="form-control" type="password" value="" name="password" id="password">
                    @error('password')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label id="password_confirmation" class="col-lg-3 col-form-label form-control-label">Confirm password</label>
                  <div class="col-lg-9">
                    <input class="form-control" type="password" value="" name="password_confirmation" id="password_confirmation">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-3 col-form-label form-control-label"></label>
                  <div class="col-lg-9">
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-4 order-lg-1 text-center">
          <img src="{{asset("images/admins/".Auth::user()->photo)}}" class="mx-auto img-circle" style="max-width: 200px;" alt="avatar">
          <h6 class="mt-2">{{Auth::user()->fullname}}</h6>
          @if(Auth::user()->id==1)
          <h6 class="mt-2">Website Owner</h6>
          @else<h6 class="mt-2">Website Administrator</h6>
        @endif
          <form class="mb-3" method="POST" action="{{route('admin.updatephoto')}}" enctype="multipart/form-data">
            @csrf
          <label class="custom-file" style="width:auto;">
            <input type="file" name="photo" id="file" class="custom-file-input" style="display: none;">
            <span class="custom-file-control btn btn-primary">Upload</span>
          </label>
            <button type="submit" class="btn btn-danger">&nbsp; Save &nbsp;</button>
          </form>
          @error('photo')
          <span class="text-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
          @enderror
        </div>
      </div>
    </div>
  </div>
  @endsection