@extends('layouts.customer')
@section('header')
    <style>

        .form-control{border-radius: 1px}
        .ui-w-80 {
            width: 80px !important;
            height: auto;
        }

        label.btn {
            margin-bottom: 0;
        }

        .btn-outline-primary {
            border-color: #26B4FF;
            background: transparent;
            color: #26B4FF;
        }

        .btn {
            cursor: pointer;
            border-radius: 1px;
        }

        .text-light {
            color: #babbbc !important;
        }

        .card {
            background-clip: padding-box;
            box-shadow: 0 1px 4px rgba(24,28,33,0.012);
        }

        .row-bordered {
            overflow: hidden;
        }

        .account-settings-fileinput {
            position: absolute;
            visibility: hidden;
            width: 1px;
            height: 1px;
            opacity: 0;
        }
        .account-settings-links .list-group-item.active {
            font-weight: bold !important;
        }
        html:not(.dark-style) .account-settings-links .list-group-item.active {
            background: transparent !important;
        }
        .account-settings-multiselect ~ .select2-container {
            width: 100% !important;
        }
        .light-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24, 28, 33, 0.03) !important;
        }
        .light-style .account-settings-links .list-group-item.active {
            color: #4e5155 !important;
        }
        .material-style .account-settings-links .list-group-item {
            padding: 0.85rem 1.5rem;
            border-color: rgba(24, 28, 33, 0.03) !important;
        }
        .material-style .account-settings-links .list-group-item.active {
            color: #4e5155 !important;
        }


    </style>
    <div class="container light-style flex-grow-1 container-p-y"style="min-height: 850px">

        <h4 class="font-weight-bold py-3 mb-4">
            Account settings
        </h4>
        @if(Session::has('message'))
        <div class="alert alert-{{Session::get('color')}} alert-dismissible fade show" role="alert">
            <strong>{{Session::get('message')}}</strong>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">

                            <form class="card-body media align-items-center" action="{{route('customer.profile.image')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <img src="{{asset('images/users/'.Auth::user()->image)}}" alt="User" height="120" width="120">
                                <div class="media-body ml-4">
                                    <label class="btn btn-outline-primary">
                                        Upload new photo
                                        <input type="file" name="image" class="account-settings-fileinput">
                                    </label> &nbsp;
                                    <button type="submit" class="btn btn-success">Done</button>
                                </div>
                                @error('image')
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </form>
                            <hr class="border-light m-0">

                            <form class="card-body" action="{{route('customer.profile.update')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input id="name" name="name" type="text" class="form-control mb-1 @error('name') is-invalid @enderror" value="{{Auth::user()->name}}">
                                    @error('name')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input id="username" name="username" type="text" class="form-control mb-1 @error('username') is-invalid @enderror" value="{{Auth::user()->username}}">
                                    @error('username')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input id="email" name="email" type="text" class="form-control mb-1 @error('email') is-invalid @enderror" value="{{Auth::user()->email}}">
                                    @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input id="mobile" name="mobile" type="text" class="form-control mb-1 @error('mobile') is-invalid @enderror" value="{{Auth::user()->mobile}}">
                                    @error('mobile')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <form class="card-body pb-2" action="{{route('customer.profile.password')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="oldpassword" class="form-label">Current password</label>
                                    <input type="password" id="oldpassword" name="oldpassword" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="password" class="form-label">New password</label>
                                    <input id="password" name="password" type="password" class="form-control">
                                    @error('password')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Repeat new password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
                                </div>
                                <div class="text-right mt-3">
                                    <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    @endsection