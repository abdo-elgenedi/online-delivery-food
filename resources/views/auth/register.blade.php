<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ordering food - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('assets/customers/login/images/icons/favicon.ico')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/login/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/login/fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/login/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/login/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/login/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/login/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/login/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/login/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/login/css/main.css')}}">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                @csrf
					<span class="login100-form-title p-b-26">
						Ordering Food
					</span>
                <span style="color: #003e80;" class="login100-form-title p-b-48">
						Register
					</span>
                <!-------------------------------------------------------------------------------->
                <div class="wrap-input100 validate-input" data-validate = "only . _ spaces">
                    <input class="input100 @error('name') is-invalid @enderror" value="{{@old('name')}}" type="text" name="name" placeholder="Enter your name">
                </div>
                @error('name')
                <div style="margin-top:-25px;"><p style="color:red;">{{$message}}</p></div>
                @enderror
                <!-------------------------------------------------------------------------------->
                <div class="wrap-input100 validate-input" data-validate = "only . _">
                    <input class="input100 @error('username') is-invalid @enderror" value="{{@old('username')}}" type="text" name="username" placeholder="Enter your username">
                </div>
                @error('username')
                <div style="margin-top:-25px;"><p style="color:red;">{{$message}}</p></div>
                @enderror
                <!-------------------------------------------------------------------------------->
                <div class="wrap-input100 validate-input" data-validate = "example@domain.com">
                    <input class="input100 @error('email') is-invalid @enderror" value="{{@old('email')}}" type="email" name="email" placeholder="Enter your email">
                </div>
                @error('email')
                <div style="margin-top:-25px;"><p style="color:red;">{{$message}}</p></div>
                @enderror
               <!-------------------------------------------------------------------------------->
                <div class="wrap-input100 validate-input" data-validate = "numbers only">
                    <input class="input100 @error('mobile') is-invalid @enderror" value="{{@old('mobile')}}" type="text" name="mobile" placeholder="Enter your mobile">
                </div>
                @error('mobile')
                <div style="margin-top:-25px;"><p style="color:red;">{{$message}}</p></div>
                @enderror
                <!-------------------------------------------------------------------------------->
                <div class="wrap-input100 validate-input" data-validate="at least upper and lower letters">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter Password">
                </div>
                @error('password')
                <div style="margin-top:-25px;"><p style="color:red;">{{$message}}</p></div>
                @enderror
                <!-------------------------------------------------------------------------------->
                <div class="wrap-input100 validate-input" data-validate="at least upper and lower letters">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
                    <input class="input100 @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Password confirmation">
                </div>
                @error('password_confirmation')
                <div style="margin-top:-25px;"><p style="color:red;">{{$message}}</p></div>
                @enderror
                <!-------------------------------------------------------------------------------->
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="{{asset('assets/customers/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/customers/login/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/customers/login/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('assets/customers/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/customers/login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/customers/login/vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('assets/customers/login/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/customers/login/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('assets/customers/login/js/main.js')}}"></script>

</body>
</html>

