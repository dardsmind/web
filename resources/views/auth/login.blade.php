@if (Auth::check())
	<script>window.location = "/dashboard";</script>
@endif

@extends('layouts.applogin')

@section('content')
<!-- BEGIN LOGIN FORM -->
<form class="login-form" action="{{ url('/login') }}" method="post">
	{{ csrf_field() }}
	<h3 class="form-title font-green">Sign In</h3>
	<div class="alert alert-danger display-hide">
		<button class="close" data-close="alert"></button>
		<span> Enter any username and password. </span>
	</div>
	<div class="form-group">
		<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
		<label class="control-label visible-ie8 visible-ie9">Username</label>
		<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="email" /> 
		@if ($errors->has('email'))
			<span class="help-block" style="color:red">{{ $errors->first('email') }}</span>
		@endif		
	</div>

	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Password</label>
		<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> 
		@if ($errors->has('password'))
				<span class="help-block" style="color:red">{{ $errors->first('password') }}</span>
		@endif		
	</div>

	<div class="form-actions">
		<button type="submit" class="btn green uppercase">Login</button>
		<label class="rememberme check">
			<input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }} />Remember </label>
		<a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
	</div>

	<div class="create-account">
		<p>
			<a href="javascript:;" id="register-btn" class="uppercase">Create an account</a>
		</p>
	</div>
</form>
<!-- END LOGIN FORM -->


<!-- BEGIN REGISTRATION FORM -->
<form class="register-form" action="{{ url('/register') }}" method="post">
	{{ csrf_field() }}
	<h3 class="font-green">Sign Up</h3>
	<p class="hint"> Enter your personal details below: </p>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Full Name</label>
		<input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="name" /> </div>
	<div class="form-group">
		<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
		<label class="control-label visible-ie8 visible-ie9">Email</label>
		<input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" /> </div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Password</label>
		<input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" /> </div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
		<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="password_confirmation" /> </div>

	<div class="form-actions">
		<button type="button" id="register-back-btn" class="btn btn-default">Back</button>
		<button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>
	</div>
</form>
<!-- END REGISTRATION FORM -->


<!-- BEGIN FORGOT PASSWORD FORM -->
<form class="forget-form" action="index.html" method="post">
	{{ csrf_field() }}
	<h3 class="font-green">Forget Password ?</h3>
	<p> Enter your e-mail address below to reset your password. </p>
	<div class="form-group">
		<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
	<div class="form-actions">
		<button type="button" id="back-btn" class="btn btn-default">Back</button>
		<button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
	</div>
</form>
<!-- END FORGOT PASSWORD FORM -->


@endsection






