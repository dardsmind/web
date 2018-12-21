@extends('layouts.app')
@section('content')
<div class="page-content">
	<!-- BEGIN PAGE BAR -->
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="{{ url('/dashboard') }}">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="{{ url('/dashboard/users') }}">User List</a>
				<i class="fa fa-circle"></i>
			</li>			
			<li>
				<a href="javascript:;">New User</a>
				<i class="fa fa-circle"></i>
			</li>			
			
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h3 class="page-title">  Create new User  
	</h3>
	<!-- END PAGE TITLE-->
	<div class="row">
		<div class="col-md-6">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<span class="caption-subject bold uppercase"> New user information</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
						<a href="javascript:;" class="reload" data-original-title="" title=""> </a>
					</div>
				 </div>
				<div class="portlet-body">
				
			
		    <form method="post" action="{{ url('/dashboard/user/new') }}" class="form-horizontal">
			  {{ csrf_field() }}
			  <div class="form-body">
				  <div class="form-group has-feedback form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label class="col-md-4 control-label">Fullname</label>
					<div class="col-md-8">
					<input type="text" class="form-control" name="name" id="name" placeholder="Full name" value="{{ old('name') }}" required autofocus>
						@if ($errors->has('name'))
							<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
						@endif		
					</div>	
				  </div>
				  <div class="form-group has-feedback form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label class="col-md-4 control-label">Email</label>
					<div class="col-md-8">			  
					<input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{ old('email') }}" required>
						@if ($errors->has('email'))
							<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
						@endif	
					</div>		
				  </div>
				  <div class="form-group has-feedback form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label class="col-md-4 control-label">Password</label>
					<div class="col-md-8">			  
					<input type="password" name="password" id="password" class="form-control" placeholder="Password">
						@if ($errors->has('password'))
							<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
						@endif	
					</div>					
				  </div>
				  <div class="form-group has-feedback">
					<label class="col-md-4 control-label">Password Confirm</label>
					<div class="col-md-8">				  
					<input type="password" id="password-confirm" name="password_confirmation" required class="form-control" placeholder="Retype password">
					</div>
				  </div>
			  </div>
				<div class="form-actions fluid">
					<div class="row">
						<div class="col-md-offset-4 col-md-12">
							<button type="submit" class="btn green">Submit</button>
							<a href="{{ url('/dashboard/users') }}" class="btn default">Cancel</a>
						</div>
					</div>
				</div>			  
			</form>		




				</div>
			</div>
			<!-- END PORTLET-->
		</div>
	</div>
</div>
@endsection


@push('scripts-footer')
<!-- DataTables -->

<script>
$( document ).ready(function() {
	
	
})
</script>  
@endpush 