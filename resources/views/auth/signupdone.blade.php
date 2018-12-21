@if (Auth::check())
	<script>window.location = "/dashboard";</script>
@endif

@extends('layouts.applogin')
@section('content')
	
<h1>Account Signup Successfull </h1>
<p>Your account has been created however it still need to be verified and approved by the Administrator</p>	

<div class="row">
	<div class="col-sm-12">
	<br/>
    <a href="{{ url('/login') }}" class="text-center">Already a registered? back to login</a>
	
	</div>
</div>
@endsection



