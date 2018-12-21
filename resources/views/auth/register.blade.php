@if (Auth::check())
	<script>window.location = "/dashboard";</script>
@endif

@extends('layouts.applogin')
@section('content')
	
<h1>{{ config('app.name', 'Laravel') }} Sign-up</h1>
<p> eFile system is a project management for all the projects in UAE. </p>	
	
    <form method="post" action="{{ url('/register') }}">
	  {{ csrf_field() }}
      <div class="form-group has-feedback form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <input type="text" class="form-control" name="name" id="name" placeholder="Full name" value="{{ old('name') }}" required autofocus>
			@if ($errors->has('name'))
				<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
			@endif		
      </div>
      <div class="form-group has-feedback form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{ old('email') }}" required>
			@if ($errors->has('email'))
				<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
			@endif		
      </div>
      <div class="form-group has-feedback form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
    			@if ($errors->has('password'))
				<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
			@endif		
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password-confirm" name="password_confirmation" required class="form-control" placeholder="Retype password">
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
	<br/>
    <a href="{{ url('/login') }}" class="text-center">Already a registered? back to login</a>
@endsection



