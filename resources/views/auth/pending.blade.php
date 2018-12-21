@if (Auth::check())
	<script>window.location = "/dashboard";</script>
@endif

@extends('layouts.applogin')
@section('content')
	
<h1>Account Pending</h1>
<p> eFile system is a project management for all the projects in UAE. </p>	

<div class="row">
	<div class="col-sm-12">
	<p>
	
	Your account is still pending, the Admin might be still validating your account, you can try contact PS-Index at +971 4 235 3000 for more details
	</p>
	<br/>
    <a href="{{ url('/login') }}" class="text-center">or back to login</a>
	</div>
</div>
@endsection



