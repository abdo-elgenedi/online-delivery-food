@include('vendor.includes.head')
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <p><b>Vendor</b>Registration</p>
    </div>

    <div class="card">
        <div class="card-body register-card-body">

            <form action="{{route('vendor.register')}}" method="POST">
                @csrf
                <div class="input-group mt-1">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Full name" name="name" value="{{ old('name') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                    @error('name')
                   <span style="color:red">{{$message}}</span>
                    @enderror

                <div class="input-group mt-3">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="username" name="username" value="{{ old('username') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user-clock"></span>
                        </div>
                    </div>
                </div>
                @error('username')
                <span style="color:red">{{$message}}</span>
                @enderror
                <div class="input-group mt-3">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                <span style="color:red">{{$message}}</span>
                @enderror
                <div class="input-group mt-3">
                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="Phone Number" name="mobile" value="{{ old('mobile') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                @error('mobile')
                <span style="color:red">{{$message}}</span>
                @enderror
                <div class="input-group mt-3">
                    <select class="form-control @error('city_id') is-invalid @enderror" name="city_id" id="city">
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-city"></span>
                        </div>
                    </div>
                </div>
                @error('city_id')
                <span style="color:red">{{$message}}</span>
                @enderror
                <div class="input-group mt-3">
                    <select class="form-control @error('state_id') is-invalid @enderror" name="state_id" id="state">
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-city"></span>
                        </div>
                    </div>
                </div>
                @error('state_id')
                <span style="color:red">{{$message}}</span>
                @enderror
                <div class="input-group mt-3">
                    <input type="number" class="form-control @error('delivery_fees') is-invalid @enderror" placeholder="delivery fees " name="delivery_fees" value="{{ old('delivery_fees') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-dollar-sign"></span>
                        </div>
                    </div>
                </div>
                @error('delivery_fees')
                <span style="color:red">{{$message}}</span>
                @enderror
                <div class="input-group mt-3">
                    <input type="text" class="form-control @error('delivery_time') is-invalid @enderror" placeholder="delivery time (Min)" name="delivery_time" value="{{ old('delivery_time') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-clock"></span>
                        </div>
                    </div>
                </div>
                @error('mobile')
                <span style="color:red">{{$message}}</span>
                @enderror
                <div class="input-group mt-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                <span style="color:red">{{$message}}</span>
                @enderror
                <div class="input-group mt-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Retype password" name="password_confirmation" >
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <!-- /.col -->
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" name="submit">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->
<script>
    window.onload=function () {
        $(document).on('change','#city',function (e) {
            var button=this;
            e.preventDefault();
            $.ajax({
                type:'get',
                url:'{{route('vendor.register.getstates')}}',
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
<!-- jQuery -->
<script src="{{asset("assets/plugins/jquery/jquery.min.js")}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset("assets/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- ChartJS -->
<script src="{{asset("assets/plugins/chart.js/Chart.min.js")}}"></script>
<!-- Sparkline -->
<script src="{{asset("assets/plugins/sparklines/sparkline.js")}}"></script>
<!-- JQVMap -->
<script src="{{asset("assets/plugins/jqvmap/jquery.vmap.min.js")}}"></script>
<script src="{{asset("assets/plugins/jqvmap/maps/jquery.vmap.usa.js")}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset("assets/plugins/jquery-knob/jquery.knob.min.js")}}"></script>
<!-- daterangepicker -->
<script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset("assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}"></script>
<!-- Summernote -->
<script src="{{asset("assets/plugins/summernote/summernote-bs4.min.js")}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset("assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("assets/dist/js/adminlte.js")}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset("assets/dist/js/pages/dashboard.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("assets/dist/js/demo.js")}}"></script>
</body>
</html>