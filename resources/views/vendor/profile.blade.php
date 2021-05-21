@extends('layouts.vendor')
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
            <li class="nav-item">
              <a href="" data-target="#password" data-toggle="tab" class="nav-link">Change Password</a>
            </li>
          </ul>
          <div class="tab-content py-4">
            <div class="tab-pane active" id="profile">
              <h1 class="mb-3" style="font-weight: bold">Vendor Profile</h1>
              <div class="row">
                <div class="col-md-12">
                @if(Session::has('success'))
                  <span class="btn btn-{{Session::get('style')}}" role="alert">
                    <strong>{{Session::get('success')}}</strong>
                  </span>
                  @endif
                  <h5 class="mt-2"> Vendor Info</h5>
                  <table class="table table-sm table-hover table-striped">
                    <div class="n In-md-8">
                      <div class="card mb-3">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-sm-3">
                                <h6 class="mb-0"> Name</h6>
                              </div>
                              <p class="mb-0 text-secondary">{{Auth::user()->name}}</p>

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
                              <p class="mb-0 text-secondary">{{Auth::user()->mobile}}</p>

                            </div>
                            <hr>
                            <div class="row">

                              <div class="col-sm-3">
                                <h6 class="mb-0">City</h6>
                              </div>
                              <p class="mb-0 text-secondary">{{isset(\App\Models\City::where('id',Auth::user()->city_id)->first()->name)?\App\Models\City::where('id',Auth::user()->city_id)->first()->name:''}}</p>

                            </div>

                            <hr>
                            <div class="row">

                              <div class="col-sm-3">
                                <h6 class="mb-0">City</h6>
                              </div>
                              <p class="mb-0 text-secondary">{{isset(\App\Models\State::where('id',Auth::user()->state_id)->first()->name)?\App\Models\State::where('id',Auth::user()->state_id)->first()->name:''}}</p>

                            </div>

                            <hr>
                            <div class="row">

                              <div class="col-sm-3">
                                <h6 class="mb-0">Delivery Fees</h6>
                              </div>
                              <p class="mb-0 text-secondary">{{Auth::user()->delivery_fees}}</p>

                            </div>

                            <hr>
                            <div class="row">

                              <div class="col-sm-3">
                                <h6 class="mb-0">Delivery Time (min)</h6>
                              </div>
                              <p class="mb-0 text-secondary">{{Auth::user()->delivery_time}} min</p>

                            </div>

                          </div>
                      </div>
                    </div>
                  </table>
                </div>
              </div>
              <!--/row-->
            </div>
            <div class="tab-pane" id="password">
              <form role="form" method="POST" action="{{ route('vendor.changepassword') }}">
                @csrf
                <input type="hidden" name="id" value="{{Auth::user()->id}}">

                <div class="form-group row">
                  <label for="email" class="col-lg-3 col-form-label form-control-label">Old Password</label>
                  <div class="col-lg-9">
                    <input class="form-control @error('oldpassword')is-invalid @enderror" type="password" name="oldpassword" id="oldpassword" required>
                    @error('oldpassword')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-lg-3 col-form-label form-control-label">New Password</label>
                  <div class="col-lg-9">
                    <input class="form-control @error('password')is-invalid @enderror" type="password" name="password" id="password" required>
                    @error('password')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password_confirmation" class="col-lg-3 col-form-label form-control-label">Confirm Password</label>
                  <div class="col-lg-9">
                    <input class="form-control @error('password_confirmation')is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" required>
                    @error('password_confirmation')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
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

            <div class="tab-pane" id="edit">
              <form role="form" method="POST" action="{{ route('vendor.updateprofile') }}">
                @csrf
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                <div class="form-group row">
                  <label for="fullname" class="col-lg-3 col-form-label form-control-label">Name</label>
                  <div class="col-lg-9">
                    <input class="form-control @error('name') is-invalid @enderror" type="text" value="{{Auth::user()->name}}" name="name" id="fullname" required>
                    @error('name')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="username" class="col-lg-3 col-form-label form-control-label">Username</label>
                  <div class="col-lg-9">
                    <input class="form-control @error('username')is-invalid @enderror" type="text" value="{{Auth::user()->username}}" name="username" id="username" required>
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
                    <input class="form-control @error('email')is-invalid @enderror" type="email" value="{{Auth::user()->email}}" name="email" id="email" required>
                    @error('email')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="mobile" class="col-lg-3 col-form-label form-control-label">Mobile</label>
                  <div class="col-lg-9">
                    <input class="form-control @error('mobile') is-invalid @enderror" type="text" value="{{Auth::user()->mobile}}" name="mobile" id="mobile" required>
                    @error('mobile')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="city" class="col-lg-3 col-form-label form-control-label">City</label>
                  <div class="col-lg-9">
                    <select class="form-control @error('city_id') is-invalid @enderror" name="city_id" id="city">
                      @foreach($cities as $city)
                        <option value="{{$city->id}}" @if($city->id==Auth::user()->city_id) selected @endif>{{$city->name}}</option>
                      @endforeach
                    </select>
                    @error('city_id')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="state" class="col-lg-3 col-form-label form-control-label">State</label>
                  <div class="col-lg-9">
                    <select class="form-control @error('state_id') is-invalid @enderror" name="state_id" id="state">
                      @foreach($states as $state)
                        <option value="{{$state->id}}" @if($state->id==Auth::user()->state_id)@endif>{{$state->name}}</option>
                      @endforeach
                    </select>
                    @error('state_id')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="delivery_fees" class="col-lg-3 col-form-label form-control-label">Delivery Fees</label>
                  <div class="col-lg-9">
                    <input class="form-control @error('delivery_fees')@enderror" type="text" value="{{Auth::user()->delivery_fees}}" name="delivery_fees" id="delivery_fees" required>
                    @error('delivery_fees')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="delivery_time" class="col-lg-3 col-form-label form-control-label">Delivery Time</label>
                  <div class="col-lg-9">
                    <input class="form-control @error('delivery_time')@enderror" type="text" value="{{Auth::user()->delivery_time}}" name="delivery_time" id="delivery_time" required>
                    @error('delivery_time')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-lg-3 col-form-label form-control-label">Password</label>
                  <div class="col-lg-9">
                    <input class="form-control" type="password" name="password" id="password">
                    @error('password')
                    <span class="alert-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
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
          <img src="{{asset("images/vendors/".Auth::user()->logo)}}" class="mx-auto img-circle" style="max-width: 200px;" alt="avatar">
          <h6 class="mt-2">{{Auth::user()->name}}</h6>
          <h6 class="mt-2">Vendor</h6>
          <form class="mb-3" method="POST" action="{{route('vendor.updatephoto')}}" enctype="multipart/form-data">
            @csrf
          <label class="custom-file" style="width:auto;">
            <input type="file" name="logo" id="file" class="custom-file-input" style="display: none;">
            <span class="custom-file-control btn btn-primary">Upload</span>
          </label>
            <button type="submit" class="btn btn-danger">&nbsp; Save &nbsp;</button>
          </form>
          @error('logo')
          <span class="text-danger" role="alert">
                        <strong>{{$message}}</strong>
                      </span>
          @enderror

          <a href="{{route('vendor.status')}}" class="btn btn-{{Auth::user()->open_status==0?'danger':'success'}}">{{Auth::user()->open_status==0?'closed':'open'}}</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    window.onload=function () {
        $(document).on('change','#city',function (e) {
            var button=this;
            e.preventDefault();
            $.ajax({
                type:'get',
                url:'{{route('vendor.profile.getstates')}}',
                data:{
                    'id':$('#city').val()
                },
                success:function (data) {
                    $('#state').children().remove().end().append('<option>States</option>');
                    for (var i in data.values) {
                        $('#state').append('<option value=' + data.values[i].id + '>' + data.values[i].name + '</option>');
                    }
                },
                error:function (reject) {

                }
            })
        });
    }
  </script>
  {{\session()->remove('success')}}
  @endsection