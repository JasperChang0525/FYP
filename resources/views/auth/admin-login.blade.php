<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
<!--===============================================================================================-->
</head>
@extends('layouts.app')

@section('content')
<body>
	<div class="limiter">
			<div class="wrap-login100">
				<form class="login100-form validate-form"method="POST" action="{{ route('admin.login.submit') }}">
                        {{ csrf_field() }}
					        <span class="login100-form-title p-b-34">
						Admin Login
					        </span>
					
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20 {{ $errors->has('email') ? ' has-error' : '' }}">
						<input id="email" type="email" class="input100" name="email" placeholder="E-mail Address" value="{{ old('email') }}" required autofocus></label>
                        <span class="focus-input100"></span>
                        @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>
                    
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20{{ $errors->has('password') ? ' has-error' : '' }}">
						<input id="password" type="password" class="input100" placeholder="Password" name="password" required>
                        <span class="focus-input100"></span>
                        @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Log in
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
							Forgot
						</span>

						<a href="{{ route('admin.password.request') }}" class="txt2">
							User name / password?
						</a>
                    </div>
                    
                    
                        <a class="btn btn-link"href="{{ route('admin.password.request') }}" class="txt2">
                            Register?
                        </a>
				</form>

				<div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>
			</div>
		</div>
	</div>

</body>
</html>
@endsection